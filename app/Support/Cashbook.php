<?php

namespace App\Support;

use App\Models\Booking;
use App\Models\CashMovement;
use App\Models\Expense;
use App\Models\KitchenOrder;

/**
 * Where the resort's cash is right now.
 *
 * This is deliberately separate from profit. Profit is income minus every expense,
 * whichever wallet paid for it. Cash is what should physically be on hand:
 *
 *   income cash = money received from bookings and the kitchen
 *                 - expenses paid from income - transfers to petty - cash taken out
 *   petty cash  = owner top-ups + transfers from income
 *                 - expenses paid from petty - cash taken out
 *
 * Owner top-ups are never income, so they raise cash without raising profit.
 */
class Cashbook
{
    public static function balances(): array
    {
        // A booking's cash is its full amount once paid; before that, only the advance
        // has actually been received.
        $bookingCash = (int) Booking::all()->sum(function ($b) {
            if ($b->invoice_status === 'paid') {
                return (int) $b->amount;
            }

            return (int) $b->advance_amount > 0 ? min((int) ($b->amount ?: $b->advance_amount), (int) $b->advance_amount) : 0;
        });
        $kitchenCash = (int) KitchenOrder::sales()->sum('total');

        $expIncome = (int) Expense::where('paid_from', '!=', 'petty')->sum('amount');
        $expPetty = (int) Expense::where('paid_from', 'petty')->sum('amount');

        $topups = (int) CashMovement::where('type', 'topup')->sum('amount');
        $transfers = (int) CashMovement::where('type', 'transfer')->sum('amount');
        $outIncome = (int) CashMovement::where('type', 'cash_out')->where('wallet', 'income')->sum('amount');
        $outPetty = (int) CashMovement::where('type', 'cash_out')->where('wallet', 'petty')->sum('amount');

        $income = $bookingCash + $kitchenCash - $expIncome - $transfers - $outIncome;
        $petty = $topups + $transfers - $expPetty - $outPetty;

        return [
            'income' => $income,
            'petty' => $petty,
            'total' => $income + $petty,
            'received' => $bookingCash + $kitchenCash,
            'booking_cash' => $bookingCash,
            'kitchen_cash' => $kitchenCash,
            'topups' => $topups,
            'transfers' => $transfers,
            'expenses_income' => $expIncome,
            'expenses_petty' => $expPetty,
            'out_income' => $outIncome,
            'out_petty' => $outPetty,
        ];
    }
}
