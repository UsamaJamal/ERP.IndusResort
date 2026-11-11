<?php

namespace App\Support;

use App\Models\Booking;
use App\Models\CashMovement;
use App\Models\Expense;
use App\Models\KitchenOrder;

/**
 * Where the resort's cash is, and who is holding it.
 *
 * This is deliberately separate from profit. Profit is income minus every expense,
 * whoever paid for it. Cash is what each holder should physically have:
 *
 *   manager cash = money the manager received from bookings and the kitchen
 *                  - expenses he paid from it - transfers to petty - cash taken out
 *                  - cash he has handed over to the owner (a cash-out to the owner)
 *   owner cash   = money the owner received directly + handovers from the manager
 *                  - expenses the owner paid - cash he took out
 *                  - petty top-ups he funded from this cash
 *   petty cash   = owner top-ups + transfers from manager cash
 *                  - expenses paid from petty - cash taken out
 *
 * A top-up from the owner's own pocket is new money: it raises cash without raising
 * profit. In the arrays below the manager's wallet keeps its original key, `income`.
 */
class Cashbook
{
    public const WALLETS = ['income' => 'Manager Cash', 'owner' => 'Owner Cash', 'petty' => 'Petty Cash'];

    /**
     * Every receipt of money, one row per part: a booking paid in two goes (advance,
     * then the balance) is two parts, because each can be received by a different person.
     *
     * `received_by` is who took the money. `holder` is who has it now: money the
     * manager received moves to the owner once a cash-out to the owner names it.
     */
    public static function parts()
    {
        $day = fn ($value, $fallback = null) => ($d = substr((string) ($value ?: $fallback), 0, 10)) !== '' ? $d : null;
        $rows = collect();
        $part = function (array $p) use ($rows) {
            $p['holder'] = $p['received_by'] === 'owner' || $p['handover_id'] ? 'owner' : 'manager';
            $rows->push($p);
        };

        foreach (Booking::all() as $b) {
            $paid = $b->invoice_status === 'paid';
            $advance = (int) $b->advance_amount > 0 ? min((int) ($b->amount ?: $b->advance_amount), (int) $b->advance_amount) : 0;
            $rest = $paid ? max(0, (int) $b->amount - $advance) : 0;
            $base = [
                'source' => 'booking', 'id' => $b->id, 'date' => $day($b->check_in, $b->created_at),
                'label' => $b->code.' · '.$b->guest_name,
                'detail' => trim(($b->room_type ?: '').($b->room_number ? ' · Room '.$b->room_number : '')),
                'group' => 'Room Bookings', 'category' => 'Room Booking', 'paid' => $paid,
            ];
            if ($advance > 0) {
                $part($base + [
                    'key' => 'b:'.$b->id.':advance', 'part' => 'advance', 'amount' => $advance,
                    'part_label' => $rest > 0 || ! $paid ? 'Advance' : 'Payment',
                    'received_by' => $b->advance_holder === 'owner' ? 'owner' : 'manager',
                    'handover_id' => $b->advance_handover_id,
                ]);
            }
            if ($rest > 0) {
                $part($base + [
                    'key' => 'b:'.$b->id.':payment', 'part' => 'payment', 'amount' => $rest,
                    'part_label' => $advance > 0 ? 'Balance' : 'Payment',
                    'received_by' => $b->payment_holder === 'owner' ? 'owner' : 'manager',
                    'handover_id' => $b->payment_handover_id,
                ]);
            }
        }

        foreach (KitchenOrder::sales()->get() as $o) {
            $part([
                'key' => 'k:'.$o->id, 'source' => 'kitchen', 'id' => $o->id, 'part' => 'payment', 'part_label' => 'Payment',
                'date' => $day($o->order_date, $o->created_at), 'amount' => (int) $o->total,
                'label' => $o->code.($o->customer_name ? ' · '.$o->customer_name : ''), 'detail' => 'Restaurant order',
                'group' => 'Kitchen Sales', 'category' => 'Kitchen Sales', 'paid' => true,
                'received_by' => $o->received_by === 'owner' ? 'owner' : 'manager',
                'handover_id' => $o->handover_id,
            ]);
        }

        return $rows;
    }

    /**
     * Every dated event that moves cash, as one flat list. `income`, `owner` and `petty`
     * are the signed change to each wallet; `profit` is the signed effect on profit,
     * which is zero for top-ups, transfers, handovers and cash-outs.
     *
     * A booking has no payment date of its own, so it is dated by check-in, falling
     * back to the day it was created when no check-in has been set.
     */
    public static function entries()
    {
        $day = fn ($value, $fallback = null) => ($d = substr((string) ($value ?: $fallback), 0, 10)) !== '' ? $d : null;
        $rows = collect();

        foreach (self::parts() as $p) {
            $toOwner = $p['received_by'] === 'owner';
            $rows->push([
                'date' => $p['date'], 'group' => $p['group'], 'label' => $p['label'],
                'detail' => trim($p['detail'].($p['source'] === 'booking' && ! $p['paid'] ? ' (advance)' : '').' · received by '.($toOwner ? 'Owner' : 'Manager'), ' ·'),
                'category' => $p['category'],
                'income' => $toOwner ? 0 : $p['amount'], 'owner' => $toOwner ? $p['amount'] : 0, 'petty' => 0,
                'profit' => $p['amount'],
            ]);
        }

        foreach (Expense::all() as $e) {
            $wallet = in_array($e->paid_from, ['petty', 'owner'], true) ? $e->paid_from : 'income';
            $rows->push([
                'date' => $day($e->date, $e->created_at), 'group' => 'Expenses', 'label' => $e->name,
                'detail' => 'Paid from '.self::WALLETS[$wallet],
                'category' => $e->category ?: 'Uncategorised',
                'income' => $wallet === 'income' ? -(int) $e->amount : 0,
                'owner' => $wallet === 'owner' ? -(int) $e->amount : 0,
                'petty' => $wallet === 'petty' ? -(int) $e->amount : 0,
                'profit' => -(int) $e->amount,
            ]);
        }

        foreach (CashMovement::all() as $m) {
            $amount = (int) $m->amount;
            $delta = ['income' => 0, 'owner' => 0, 'petty' => 0];
            $group = 'Other';
            if ($m->type === 'topup') {
                $group = 'Owner Top-ups';
                $delta['petty'] = $amount;
                if ($m->source === 'owner') {
                    $delta['owner'] = -$amount;
                }
            } elseif ($m->type === 'transfer') {
                $group = 'Transfers (Manager to Petty)';
                $delta['income'] = -$amount;
                $delta['petty'] = $amount;
            } elseif ($m->type === 'handover') {
                $group = 'Cash Out to Owner';
                $delta['income'] = -$amount;
                $delta['owner'] = $amount;
            } elseif ($m->type === 'cash_out') {
                $group = 'Cash Out';
                $delta[in_array($m->wallet, ['petty', 'owner'], true) ? $m->wallet : 'income'] = -$amount;
            }
            $rows->push([
                'date' => $day($m->date, $m->created_at), 'group' => $group,
                'label' => CashMovement::TYPES[$m->type] ?? 'Cash entry',
                'detail' => (string) $m->note, 'category' => $group,
                'profit' => 0,
            ] + $delta);
        }

        return $rows->sortBy('date')->values();
    }

    /** What each wallet holds right now. */
    public static function balances(): array
    {
        $all = self::entries();
        $income = (int) $all->sum('income');
        $owner = (int) $all->sum('owner');
        $petty = (int) $all->sum('petty');

        return [
            'income' => $income, 'manager' => $income, 'owner' => $owner, 'petty' => $petty,
            'total' => $income + $owner + $petty,
        ];
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
        $owner = $wallet('owner');
        $petty = $wallet('petty');

        // What a row does to the cash as a whole. Moving money between wallets (a transfer,
        // a handover, a top-up out of owner cash) nets to nothing, so it is not counted
        // as money coming in or going out of the business.
        $net = fn ($r) => $r['income'] + $r['owner'] + $r['petty'];
        $totalIn = (int) $period->sum(fn ($r) => max(0, $net($r)));
        $totalOut = (int) $period->sum(fn ($r) => max(0, -$net($r)));
        $opening = $income['opening'] + $owner['opening'] + $petty['opening'];

        // Money in by source, and money out by expense category.
        $sources = $period->filter(fn ($r) => $net($r) > 0)
            ->groupBy('group')->map(fn ($g) => ['count' => $g->count(), 'amount' => (int) $g->sum($net)]);
        $expenses = $period->where('group', 'Expenses');
        $byCategory = $expenses->groupBy('category')->map(fn ($g) => [
            'count' => $g->count(),
            'income' => (int) -$g->sum('income'),
            'owner' => (int) -$g->sum('owner'),
            'petty' => (int) -$g->sum('petty'),
            'amount' => (int) -$g->sum('profit'),
        ])->sortByDesc('amount');
        $cashOut = $period->where('group', 'Cash Out');

        $earned = (int) $period->sum(fn ($r) => max(0, $r['profit']));
        $spent = (int) $period->sum(fn ($r) => max(0, -$r['profit']));

        return [
            'from' => $from, 'to' => $to,
            'income' => $income, 'owner' => $owner, 'petty' => $petty,
            'total' => ['opening' => $opening, 'in' => $totalIn, 'out' => $totalOut, 'closing' => $opening + $totalIn - $totalOut],
            'sources' => $sources,
            'byCategory' => $byCategory,
            'expenseTotal' => ['income' => (int) -$expenses->sum('income'), 'owner' => (int) -$expenses->sum('owner'), 'petty' => (int) -$expenses->sum('petty'), 'amount' => $spent],
            'cashOut' => ['income' => (int) -$cashOut->sum('income'), 'owner' => (int) -$cashOut->sum('owner'), 'petty' => (int) -$cashOut->sum('petty')],
            'handovers' => (int) $period->where('group', 'Cash Out to Owner')->sum('owner'),
            'profit' => ['earned' => $earned, 'spent' => $spent, 'net' => $earned - $spent],
            'entries' => $period,
        ];
    }
}
