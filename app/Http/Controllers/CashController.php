<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\CashMovement;
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
            'wallet' => ['nullable', Rule::in(['income', 'petty'])],
            'amount' => 'required|integer|min:1|max:100000000',
            'date' => 'nullable|date',
            'note' => 'nullable|string|max:255',
        ]);
    }

    public function update(Request $r, $id)
    {
        $movement = CashMovement::findOrFail($id);
        $data = $this->validated($r);
        $receipts = Attachment::uploaded($r, ['receipts', 'receipt']);

        $changes = [
            'type' => $data['type'],
            'wallet' => $data['type'] === 'cash_out' ? ($data['wallet'] ?? 'income') : 'petty',
            'amount' => (int) $data['amount'],
            'date' => $data['date'] ?? $movement->date,
            'note' => $data['note'] ?? null,
        ];
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
            'paid_from' => ['required', Rule::in(['income', 'petty'])],
        ]);

        $count = Expense::whereIn('id', $data['ids'])->update(['paid_from' => $data['paid_from']]);

        return back()->with('ok', $count.' '.($count === 1 ? 'expense' : 'expenses').' now paid from '.($data['paid_from'] === 'petty' ? 'Petty Cash' : 'Income Cash').'.');
    }
}
