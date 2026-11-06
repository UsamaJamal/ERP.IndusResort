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

    /**
     * Every dated event that moves cash, as one flat list. `income` and `petty` are the
     * signed change to each wallet; `profit` is the signed effect on profit, which is
     * zero for top-ups, transfers and cash-outs because they are not earnings or costs.
     *
     * A booking has no payment date of its own, so it is dated by check-in, falling
     * back to the day it was created when no check-in has been set.
     */
    public static function entries()
    {
        $day = fn ($value, $fallback = null) => $value ? substr((string) $value, 0, 10) : ($fallback ? substr((string) $fallback, 0, 10) : null);
        $rows = collect();

        foreach (Booking::all() as $b) {
            $cash = $b->invoice_status === 'paid'
                ? (int) $b->amount
                : ((int) $b->advance_amount > 0 ? min((int) ($b->amount ?: $b->advance_amount), (int) $b->advance_amount) : 0);
            if ($cash <= 0) {
                continue;
            }
            $rows->push([
                'date' => $day($b->check_in, $b->created_at),
                'group' => 'Room Bookings',
                'label' => $b->code.' · '.$b->guest_name,
                'detail' => trim(($b->room_type ?: '').($b->room_number ? ' · Room '.$b->room_number : '')).($b->invoice_status === 'paid' ? '' : ' (advance)'),
                'category' => 'Room Booking',
                'income' => $cash, 'petty' => 0, 'profit' => $cash,
            ]);
        }

        foreach (KitchenOrder::sales()->get() as $o) {
            $rows->push([
                'date' => $day($o->order_date, $o->created_at),
                'group' => 'Kitchen Sales',
                'label' => $o->code.($o->customer_name ? ' · '.$o->customer_name : ''),
                'detail' => 'Restaurant order',
                'category' => 'Kitchen Sales',
                'income' => (int) $o->total, 'petty' => 0, 'profit' => (int) $o->total,
            ]);
        }

        foreach (Expense::all() as $e) {
            $petty = $e->paid_from === 'petty';
            $rows->push([
                'date' => $day($e->date, $e->created_at),
                'group' => 'Expenses',
                'label' => $e->name,
                'detail' => 'Paid from '.($petty ? 'Petty Cash' : 'Income Cash'),
                'category' => $e->category ?: 'Uncategorised',
                'income' => $petty ? 0 : -(int) $e->amount,
                'petty' => $petty ? -(int) $e->amount : 0,
                'profit' => -(int) $e->amount,
            ]);
        }

        foreach (CashMovement::all() as $m) {
            $amount = (int) $m->amount;
            [$group, $income, $pettyDelta] = [
                'topup' => ['Owner Top-ups', 0, $amount],
                'transfer' => ['Transfers (Income to Petty)', -$amount, $amount],
                'cash_out' => ['Cash Out', $m->wallet === 'petty' ? 0 : -$amount, $m->wallet === 'petty' ? -$amount : 0],
            ][$m->type] ?? ['Other', 0, 0];
            $rows->push([
                'date' => $day($m->date, $m->created_at),
                'group' => $group,
                'label' => CashMovement::TYPES[$m->type] ?? 'Cash entry',
                'detail' => (string) $m->note,
                'category' => $group,
                'income' => $income, 'petty' => $pettyDelta, 'profit' => 0,
            ]);
        }

        return $rows->sortBy('date')->values();
    }

    /**
     * A statement for a date range: what each wallet held before it, what came in and
     * went out during it, and what it held at the end.
     */
    public static function statement(string $from, string $to): array
    {
        $all = self::entries();
        $before = $all->filter(fn ($r) => $r['date'] !== null && $r['date'] < $from);
        $period = $all->filter(fn ($r) => $r['date'] !== null && $r['date'] >= $from && $r['date'] <= $to)->values();

        $wallet = function (string $w) use ($before, $period) {
            $opening = (int) $before->sum($w);
            $in = (int) $period->sum(fn ($r) => max(0, $r[$w]));
            $out = (int) $period->sum(fn ($r) => max(0, -$r[$w]));

            return ['opening' => $opening, 'in' => $in, 'out' => $out, 'closing' => $opening + $in - $out];
        };
        $income = $wallet('income');
        $petty = $wallet('petty');

        // Money in by source, and money out by expense category.
        $sources = $period->filter(fn ($r) => $r['income'] > 0 || $r['petty'] > 0)
            ->groupBy('group')->map(fn ($g) => ['count' => $g->count(), 'amount' => (int) $g->sum(fn ($r) => max(0, $r['income']) + max(0, $r['petty']))]);
        $expenses = $period->where('group', 'Expenses');
        $byCategory = $expenses->groupBy('category')->map(fn ($g) => [
            'count' => $g->count(),
            'income' => (int) -$g->sum('income'),
            'petty' => (int) -$g->sum('petty'),
            'amount' => (int) -$g->sum('profit'),
        ])->sortByDesc('amount');
        $cashOut = $period->where('group', 'Cash Out');

        $earned = (int) $period->sum(fn ($r) => max(0, $r['profit']));
        $spent = (int) $period->sum(fn ($r) => max(0, -$r['profit']));

        return [
            'from' => $from, 'to' => $to,
            'income' => $income, 'petty' => $petty,
            'total' => [
                'opening' => $income['opening'] + $petty['opening'],
                // A transfer leaves one wallet and enters the other, so it is not new cash overall.
                'in' => $income['in'] + $petty['in'] - (int) $period->where('group', 'Transfers (Income to Petty)')->sum('petty'),
                'out' => $income['out'] + $petty['out'] - (int) $period->where('group', 'Transfers (Income to Petty)')->sum('petty'),
                'closing' => $income['closing'] + $petty['closing'],
            ],
            'sources' => $sources,
            'byCategory' => $byCategory,
            'expenseTotal' => ['income' => (int) -$expenses->sum('income'), 'petty' => (int) -$expenses->sum('petty'), 'amount' => $spent],
            'cashOut' => ['income' => (int) -$cashOut->sum('income'), 'petty' => (int) -$cashOut->sum('petty')],
            'profit' => ['earned' => $earned, 'spent' => $spent, 'net' => $earned - $spent],
            'entries' => $period,
        ];
    }
}
