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
     * Everything below is worked out once per request and kept here. A page asks for
     * balances, a statement and the list of parts, and each of those used to read every
     * booking, order, expense and cash entry again. Saving or deleting any of them
     * empties this (see AppServiceProvider), so nothing stale is ever handed out.
     */
    private static $memo = [];

    public static function flush(): void
    {
        self::$memo = [];
    }

    private static function once(string $key, callable $make)
    {
        if (! array_key_exists($key, self::$memo)) {
            self::$memo[$key] = $make();
        }

        return self::$memo[$key];
    }

    /** The day a record counts on: its own date, or the day it was entered when it has none. */
    private static function day($value, $fallback = null): ?string
    {
        return ($d = substr((string) ($value ?: $fallback), 0, 10)) !== '' ? $d : null;
    }

    /*
     * The four tables, read as plain rows with only the columns the sums need, each row
     * carrying the `day` it counts on. Plain rows cost a fraction of full models, which
     * matters once there are tens of thousands of them.
     */
    public static function bookings()
    {
        return self::once('bookings', fn () => Booking::query()->toBase()->orderBy('id')->get([
            'id', 'code', 'guest_name', 'room_type', 'room_number', 'amount', 'advance_amount', 'invoice_status',
            'check_in', 'created_at', 'advance_holder', 'payment_holder', 'advance_handover_id', 'payment_handover_id',
        ])->each(function ($b) {
            $b->id = (int) $b->id; // a model gives its key as a number; a plain row may not
            $b->day = self::day($b->check_in, $b->created_at);
        }));
    }

    public static function sales()
    {
        return self::once('sales', fn () => KitchenOrder::sales()->toBase()->orderBy('id')->get([
            'id', 'code', 'customer_name', 'total', 'order_date', 'created_at', 'received_by', 'handover_id',
        ])->each(function ($o) {
            $o->id = (int) $o->id; // a model gives its key as a number; a plain row may not
            $o->day = self::day($o->order_date, $o->created_at);
        }));
    }

    public static function expenses()
    {
        return self::once('expenses', fn () => Expense::query()->toBase()->orderBy('id')->get([
            'id', 'name', 'category', 'amount', 'date', 'created_at', 'paid_from',
        ])->each(function ($e) {
            $e->id = (int) $e->id; // a model gives its key as a number; a plain row may not
            $e->day = self::day($e->date, $e->created_at);
        }));
    }

    public static function movements()
    {
        return self::once('movements', fn () => CashMovement::query()->toBase()->orderBy('id')->get([
            'id', 'type', 'wallet', 'source', 'amount', 'date', 'note', 'created_at',
        ])->each(function ($m) {
            $m->id = (int) $m->id; // a model gives its key as a number; a plain row may not
            $m->day = self::day($m->date, $m->created_at);
        }));
    }

    /** Parts filed two ways in one pass: by the record they belong to, and by the cash-out that moved them. */
    private static function partIndex(): array
    {
        return self::once('parts.index', function () {
            $bySource = $byHandover = [];
            foreach (self::parts() as $p) {
                $bySource[$p['source'].':'.$p['id']][] = $p;
                if ($p['handover_id']) {
                    $byHandover[$p['handover_id']][] = $p;
                }
            }

            return ['source' => $bySource, 'handover' => $byHandover];
        });
    }

    /** The parts of one booking or kitchen order, found without scanning the whole list. */
    public static function partsOf(string $source, $id)
    {
        return collect(self::partIndex()['source'][$source.':'.$id] ?? []);
    }

    /** The parts a cash-out to the owner was made up of. */
    public static function partsIn($handoverId)
    {
        return collect(self::partIndex()['handover'][$handoverId] ?? []);
    }

    /**
     * Every receipt of money, one row per part: a booking paid in two goes (advance,
     * then the balance) is two parts, because each can be received by a different person.
     *
     * `received_by` is who took the money. `holder` is who has it now: money the
     * manager received moves to the owner once a cash-out to the owner names it.
     */
    public static function parts()
    {
        return self::once('parts', fn () => self::buildParts());
    }

    private static function buildParts()
    {
        $rows = collect();
        $part = function (array $p) use ($rows) {
            $p['holder'] = $p['received_by'] === 'owner' || $p['handover_id'] ? 'owner' : 'manager';
            $rows->push($p);
        };

        foreach (self::bookings() as $b) {
            $paid = $b->invoice_status === 'paid';
            $advance = (int) $b->advance_amount > 0 ? min((int) ($b->amount ?: $b->advance_amount), (int) $b->advance_amount) : 0;
            $rest = $paid ? max(0, (int) $b->amount - $advance) : 0;
            $base = [
                'source' => 'booking', 'id' => $b->id, 'date' => $b->day,
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

        foreach (self::sales() as $o) {
            $part([
                'key' => 'k:'.$o->id, 'source' => 'kitchen', 'id' => $o->id, 'part' => 'payment', 'part_label' => 'Payment',
                'date' => $o->day, 'amount' => (int) $o->total,
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
        return self::once('entries', fn () => self::rows()->sortBy('date')->values());
    }

    /** The same rows in no particular order, for the sums: sorting tens of thousands of rows is only worth it for a printed list. */
    public static function rows()
    {
        return self::once('rows', fn () => self::buildRows());
    }

    /** The earliest day anything was recorded, or null when the books are empty. */
    public static function firstDay(): ?string
    {
        return self::once('firstDay', function () {
            $first = null;
            foreach (self::rows() as $r) {
                if ($r['date'] !== null && ($first === null || $r['date'] < $first)) {
                    $first = $r['date'];
                }
            }

            return $first;
        });
    }

    private static function buildRows()
    {
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

        foreach (self::expenses() as $e) {
            $wallet = in_array($e->paid_from, ['petty', 'owner'], true) ? $e->paid_from : 'income';
            $rows->push([
                'date' => $e->day, 'group' => 'Expenses', 'label' => $e->name,
                'detail' => 'Paid from '.self::WALLETS[$wallet],
                'category' => $e->category ?: 'Uncategorised',
                'income' => $wallet === 'income' ? -(int) $e->amount : 0,
                'owner' => $wallet === 'owner' ? -(int) $e->amount : 0,
                'petty' => $wallet === 'petty' ? -(int) $e->amount : 0,
                'profit' => -(int) $e->amount,
            ]);
        }

        foreach (self::movements() as $m) {
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
                'date' => $m->day, 'group' => $group,
                'label' => CashMovement::TYPES[$m->type] ?? 'Cash entry',
                'detail' => (string) $m->note, 'category' => $group,
                'profit' => 0,
            ] + $delta);
        }

        return $rows;
    }

    /** What each wallet holds right now. */
    public static function balances(): array
    {
        return self::once('balances', fn () => self::buildBalances());
    }

    private static function buildBalances(): array
    {
        $income = $owner = $petty = 0;
        foreach (self::rows() as $r) {
            $income += $r['income'];
            $owner += $r['owner'];
            $petty += $r['petty'];
        }

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
        // One pass over everything: rows before the range only add to the opening balances,
        // rows inside it are kept, the rest are ignored.
        $openings = ['income' => 0, 'owner' => 0, 'petty' => 0];
        $inside = [];
        foreach (self::rows() as $r) {
            if ($r['date'] === null) {
                continue;
            }
            if ($r['date'] < $from) {
                $openings['income'] += $r['income'];
                $openings['owner'] += $r['owner'];
                $openings['petty'] += $r['petty'];
            } elseif ($r['date'] <= $to) {
                $inside[] = $r;
            }
        }
        $period = collect($inside)->sortBy('date')->values();

        $wallet = function (string $w) use ($openings, $period) {
            $opening = (int) $openings[$w];
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
