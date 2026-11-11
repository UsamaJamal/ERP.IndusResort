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
            // A handover is recorded on its own form, with the receipts it covers.
            'type' => ['required', Rule::in(['topup', 'transfer', 'cash_out'])],
            'wallet' => ['nullable', Rule::in(['income', 'petty', 'owner'])],
            'source' => ['nullable', Rule::in(['pocket', 'owner'])],
            'amount' => 'required|integer|min:1|max:100000000',
            'date' => 'nullable|date',
            'note' => 'nullable|string|max:255',
        ]);
    }

    public function update(Request $r, $id)
    {
        $movement = CashMovement::findOrFail($id);
        $receipts = Attachment::uploaded($r, ['receipts', 'receipt']);
        if ($movement->type === 'handover') {
            // Its amount comes from the receipts it covers, so only the date, note and files change.
            $data = $r->validate(['date' => 'nullable|date', 'note' => 'nullable|string|max:255']);
            $changes = ['date' => $data['date'] ?? $movement->date, 'note' => $data['note'] ?? null];
        } else {
            $data = $this->validated($r);
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

    public function destroy($id)
    {
        $movement = CashMovement::findOrFail($id);
        if ($movement->type === 'handover') {
            // Everything it covered goes back to being with the manager and unsettled.
            DB::transaction(function () use ($movement) {
                Booking::where('advance_handover_id', $movement->id)->update(['advance_handover_id' => null]);
                Booking::where('payment_handover_id', $movement->id)->update(['payment_handover_id' => null]);
                KitchenOrder::where('handover_id', $movement->id)->update(['handover_id' => null]);
                Expense::where('handover_id', $movement->id)->update(['handover_id' => null]);
                CashMovement::where('handover_id', $movement->id)->update(['handover_id' => null]);
            });
        }
        Attachment::purge('cash', $movement->id);
        $movement->delete();

        return back()->with('ok', 'Cash entry deleted.');
    }

    /**
     * The manager hands cash to the owner. He ticks the receipts whose money he is
     * handing over; everything he has paid out of manager cash since the last handover
     * comes off automatically, and the rest is the cash that changes hands.
     */
    public function handover(Request $r)
    {
        $data = $r->validate([
            'parts' => 'required|array|min:1',
            'parts.*' => ['string', 'regex:/^(b:\d+:(advance|payment)|k:\d+)$/'],
            'date' => 'nullable|date',
            'note' => 'nullable|string|max:255',
        ], ['parts.required' => 'Tick at least one entry to hand over.']);
        $receipts = Attachment::uploaded($r, ['receipts']);

        $keys = array_values(array_unique($data['parts']));
        $parts = Cashbook::parts()->whereIn('key', $keys)->where('holder', 'manager')->values();
        if ($parts->count() !== count($keys)) {
            return back()->withErrors(['parts' => 'Some of those entries are no longer with the manager. Reload the page and try again.']);
        }
        $spent = Cashbook::unsettled();
        $gross = (int) $parts->sum('amount');
        $deduct = (int) $spent->sum('amount');
        $net = $gross - $deduct;
        if ($net < 0) {
            return back()->withErrors(['parts' => 'The manager has paid out PKR '.number_format($deduct).' since the last handover, more than the PKR '.number_format($gross).' ticked. Tick more entries.']);
        }

        $movement = DB::transaction(function () use ($data, $parts, $spent, $net) {
            $movement = CashMovement::create([
                'type' => 'handover', 'wallet' => 'income', 'amount' => $net,
                'date' => $data['date'] ?? now()->toDateString(),
                'note' => $data['note'] ?? null,
                'user_id' => auth()->id(),
                // The owner recording it himself needs no second confirmation.
                'confirmed_at' => auth()->user()->role === 'admin' ? now() : null,
            ]);
            foreach ($parts as $p) {
                if ($p['source'] === 'booking') {
                    Booking::where('id', $p['id'])->update([$p['part'].'_handover_id' => $movement->id]);
                } else {
                    KitchenOrder::where('id', $p['id'])->update(['handover_id' => $movement->id]);
                }
            }
            Expense::whereIn('id', $spent->where('kind', 'expense')->pluck('id'))->update(['handover_id' => $movement->id]);
            CashMovement::whereIn('id', $spent->where('kind', 'cash')->pluck('id'))->update(['handover_id' => $movement->id]);

            return $movement;
        });
        Attachment::attach($receipts, 'cash', $movement->id);

        return back()->with('ok', 'Handover recorded: PKR '.number_format($gross).' ticked, PKR '.number_format($deduct).' already spent, PKR '.number_format($net).' to the owner.');
    }

    /** The owner agrees that money recorded as his really reached him. Admin only. */
    public function confirm(Request $r)
    {
        $data = $r->validate([
            'items' => 'required|array|min:1',
            'items.*' => ['string', 'regex:/^(b:\d+:(advance|payment)|k:\d+|h:\d+)$/'],
        ]);
        $done = 0;
        foreach (array_unique($data['items']) as $item) {
            $bits = explode(':', $item);
            if ($bits[0] === 'b') {
                $done += Booking::where('id', $bits[1])->where($bits[2].'_holder', 'owner')->whereNull($bits[2].'_confirmed_at')->update([$bits[2].'_confirmed_at' => now()]);
            } elseif ($bits[0] === 'k') {
                $done += KitchenOrder::where('id', $bits[1])->where('received_by', 'owner')->whereNull('owner_confirmed_at')->update(['owner_confirmed_at' => now()]);
            } else {
                $done += CashMovement::where('id', $bits[1])->where('type', 'handover')->whereNull('confirmed_at')->update(['confirmed_at' => now()]);
            }
        }

        return back()->with('ok', $done.' '.($done === 1 ? 'entry' : 'entries').' confirmed as received by the owner.');
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
