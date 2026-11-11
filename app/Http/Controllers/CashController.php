<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Booking;
use App\Models\CashMovement;
use App\Models\KitchenOrder;
use Illuminate\Support\Facades\DB;
use App\Models\Expense;
use App\Support\Cashbook;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/** Cash entries on the Financials page: petty top-ups, transfers and cash out. */
class CashController extends Controller
{
    private function validated(Request $r): array
    {
        return $r->validate([
            'type' => ['required', Rule::in(array_keys(CashMovement::TYPES))],
            'wallet' => ['nullable', Rule::in(['income', 'petty', 'owner'])],
            'source' => ['nullable', Rule::in(['pocket', 'owner'])],
            // A cash-out to the owner may leave the amount blank: it is then the entries picked.
            'amount' => [Rule::requiredIf(fn () => $r->input('type') !== 'handover'), 'nullable', 'integer', 'min:1', 'max:100000000'],
            'parts' => 'nullable|array',
            'parts.*' => ['string', 'regex:/^(b:\d+:(advance|payment)|k:\d+)$/'],
            'date' => 'nullable|date',
            'note' => 'nullable|string|max:255',
        ]);
    }

    public function update(Request $r, $id)
    {
        $movement = CashMovement::findOrFail($id);
        $receipts = Attachment::uploaded($r, ['receipts', 'receipt']);
        if ($movement->type === 'handover') {
            // What it was made up of is fixed, so only the date, note and files change.
            $data = $r->validate(['date' => 'nullable|date', 'note' => 'nullable|string|max:255']);
            $changes = ['date' => $data['date'] ?? $movement->date, 'note' => $data['note'] ?? null];
        } else {
            $data = $this->validated($r);
            if ($data['type'] === 'handover') {
                return back()->withErrors(['type' => 'Record a cash-out to the owner as a new entry, so its income entries can be picked.']);
            }
            $changes = [
                'type' => $data['type'],
                'wallet' => $data['type'] === 'cash_out' ? ($data['wallet'] ?? 'income') : 'petty',
                'source' => $data['type'] === 'topup' ? ($data['source'] ?? 'pocket') : null,
                'amount' => (int) $data['amount'],
                'date' => $data['date'] ?? $movement->date,
                'note' => $data['note'] ?? null,
            ];
        }
        $movement->update($changes);
        Attachment::detach($r->input('remove_attachments', []), 'cash', $movement->id);
        Attachment::attach($receipts, 'cash', $movement->id);

        return back()->with('ok', 'Cash entry updated.');
    }

    public function store(Request $r)
    {
        $data = $this->validated($r);
        $receipts = Attachment::uploaded($r, ['receipts', 'receipt']);
        if ($data['type'] === 'handover') {
            return $this->storeHandover($data, $receipts);
        }

        $movement = CashMovement::create([
            'type' => $data['type'],
            // Only a cash-out chooses its wallet; the other two always land in petty.
            'wallet' => $data['type'] === 'cash_out' ? ($data['wallet'] ?? 'income') : 'petty',
            // A top-up is the owner's own money unless he says it comes from the business cash he holds.
            'source' => $data['type'] === 'topup' ? ($data['source'] ?? 'pocket') : null,
            'amount' => (int) $data['amount'],
            'date' => $data['date'] ?? now()->toDateString(),
            'note' => $data['note'] ?? null,
            'user_id' => auth()->id(),
        ]);

        Attachment::attach($receipts, 'cash', $movement->id);

        return back()->with('ok', CashMovement::TYPES[$movement->type].' of PKR '.number_format($movement->amount).' recorded.');
    }

    /**
     * Cash out to the owner: the manager picks the income entries the cash is from and
     * hands it over. Those entries then read as with the owner. The amount is the entries
     * picked unless a smaller one is typed, and never more than the manager is holding.
     */
    private function storeHandover(array $data, array $receipts)
    {
        $keys = array_values(array_unique($data['parts'] ?? []));
        if (! $keys) {
            return back()->withErrors(['parts' => 'Select the income entries this cash is from.'])->withInput();
        }
        $parts = Cashbook::parts()->whereIn('key', $keys)->where('holder', 'manager')->values();
        if ($parts->count() !== count($keys)) {
            return back()->withErrors(['parts' => 'Some of those entries are no longer with the manager. Reload the page and try again.'])->withInput();
        }
        $picked = (int) $parts->sum('amount');
        $held = (int) Cashbook::balances()['income'];
        $most = min($picked, $held);
        $amount = (int) ($data['amount'] ?? $most);
        if ($most <= 0) {
            return back()->withErrors(['amount' => 'The manager has no cash in hand to give to the owner.'])->withInput();
        }
        if ($amount > $most) {
            return back()->withErrors(['amount' => 'The most that can be handed over is PKR '.number_format($most).': the entries picked come to PKR '.number_format($picked).' and the manager is holding PKR '.number_format($held).'.'])->withInput();
        }

        $movement = DB::transaction(function () use ($data, $parts, $amount) {
            $movement = CashMovement::create([
                'type' => 'handover', 'wallet' => 'income', 'amount' => $amount,
                'date' => $data['date'] ?? now()->toDateString(),
                'note' => $data['note'] ?? null,
                'user_id' => auth()->id(),
            ]);
            foreach ($parts as $p) {
                if ($p['source'] === 'booking') {
                    Booking::where('id', $p['id'])->update([$p['part'].'_handover_id' => $movement->id]);
                } else {
                    KitchenOrder::where('id', $p['id'])->update(['handover_id' => $movement->id]);
                }
            }

            return $movement;
        });
        Attachment::attach($receipts, 'cash', $movement->id);

        return back()->with('ok', 'Cash out to owner recorded: PKR '.number_format($amount).' from '.$parts->count().' '.($parts->count() === 1 ? 'entry' : 'entries').'.');
    }

    public function destroy($id)
    {
        $movement = CashMovement::findOrFail($id);
        if ($movement->type === 'handover') {
            // The entries it was made up of go back to being with the manager.
            DB::transaction(function () use ($movement) {
                Booking::where('advance_handover_id', $movement->id)->update(['advance_handover_id' => null]);
                Booking::where('payment_handover_id', $movement->id)->update(['payment_handover_id' => null]);
                KitchenOrder::where('handover_id', $movement->id)->update(['handover_id' => null]);
            });
        }
        Attachment::purge('cash', $movement->id);
        $movement->delete();

        return back()->with('ok', 'Cash entry deleted.');
    }

    /** A cash statement for a chosen date range, as a PDF. */
    public function report(Request $r)
    {
        $data = $r->validate([
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from',
            'detail' => 'nullable|boolean',
        ]);

        $statement = Cashbook::statement($data['from'], $data['to']);
        $html = view('pdf.cash-report', [
            'st' => $statement,
            'detail' => $r->boolean('detail'),
            'by' => auth()->user()->name,
        ])->render();

        $tempDir = storage_path('app/mpdf');
        if (! is_dir($tempDir)) {
            mkdir($tempDir, 0775, true);
        }
        $fontDirs = (new \Mpdf\Config\ConfigVariables())->getDefaults()['fontDir'];
        $fontData = (new \Mpdf\Config\FontVariables())->getDefaults()['fontdata'];
        $pdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 'format' => 'A4',
            'margin_top' => 13, 'margin_bottom' => 13, 'margin_left' => 12, 'margin_right' => 12,
            'tempDir' => $tempDir,
            'fontDir' => array_merge($fontDirs, [resource_path('fonts')]),
            'fontdata' => $fontData + ['lato' => ['R' => 'Lato-Regular.ttf', 'B' => 'Lato-Bold.ttf', 'I' => 'Lato-Italic.ttf']],
            'default_font' => 'lato',
        ]);
        $pdf->SetTitle('Cash Report');
        $pdf->WriteHTML($html);

        return response($pdf->Output('', \Mpdf\Output\Destination::STRING_RETURN), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="cash-report-'.$data['from'].'-to-'.$data['to'].'.pdf"',
        ]);
    }

    /** Move several expenses to one wallet at once; used to sort out older entries. */
    public function reassign(Request $r)
    {
        $data = $r->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer',
            'paid_from' => ['required', Rule::in(['income', 'petty', 'owner'])],
        ]);

        $count = Expense::whereIn('id', $data['ids'])->update(['paid_from' => $data['paid_from']]);

        return back()->with('ok', $count.' '.($count === 1 ? 'expense' : 'expenses').' now paid from '.Cashbook::WALLETS[$data['paid_from']].'.');
    }
}
