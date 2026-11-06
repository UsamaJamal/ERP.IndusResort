<?php

namespace App\Http\Controllers;

use App\Models\CashMovement;
use App\Models\Expense;
use App\Support\Cashbook;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/** Cash entries on the Financials page: petty top-ups, transfers and cash out. */
class CashController extends Controller
{
    public function store(Request $r)
    {
        $data = $r->validate([
            'type' => ['required', Rule::in(array_keys(CashMovement::TYPES))],
            'wallet' => ['nullable', Rule::in(['income', 'petty'])],
            'amount' => 'required|integer|min:1|max:100000000',
            'date' => 'nullable|date',
            'note' => 'nullable|string|max:255',
            'receipt' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ], [
            'receipt.mimes' => 'The receipt must be an image (JPG, PNG, WebP) or a PDF.',
            'receipt.max' => 'The receipt must be 5 MB or smaller.',
        ]);

        $movement = CashMovement::create([
            'type' => $data['type'],
            // Only a cash-out chooses its wallet; the other two always land in petty.
            'wallet' => $data['type'] === 'cash_out' ? ($data['wallet'] ?? 'income') : 'petty',
            'amount' => (int) $data['amount'],
            'date' => $data['date'] ?? now()->toDateString(),
            'note' => $data['note'] ?? null,
            'user_id' => auth()->id(),
        ]);

        if ($r->hasFile('receipt')) {
            $directory = public_path('uploads/cash-receipts');
            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            $file = $r->file('receipt');
            $name = 'cash_'.$movement->id.'_'.time().'_'.uniqid().'.'.strtolower($file->getClientOriginalExtension());
            $file->move($directory, $name);
            $movement->update(['receipt_path' => 'uploads/cash-receipts/'.$name]);
        }

        return back()->with('ok', CashMovement::TYPES[$movement->type].' of PKR '.number_format($movement->amount).' recorded.');
    }

    public function destroy($id)
    {
        $movement = CashMovement::findOrFail($id);
        // Remove the stored receipt too, but only if it really lives in the cash uploads folder.
        $path = (string) $movement->receipt_path;
        if ($path !== '' && strpos($path, 'uploads/cash-receipts/') === 0 && is_file(public_path($path))) {
            @unlink(public_path($path));
        }
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
