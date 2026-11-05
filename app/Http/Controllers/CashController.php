<?php

namespace App\Http\Controllers;

use App\Models\CashMovement;
use App\Models\Expense;
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

        return back()->with('ok', CashMovement::TYPES[$movement->type].' of PKR '.number_format($movement->amount).' recorded.');
    }

    public function destroy($id)
    {
        CashMovement::findOrFail($id)->delete();

        return back()->with('ok', 'Cash entry deleted.');
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
