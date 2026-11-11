<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Expense;
use App\Models\KitchenOrder;
use App\Models\KitchenOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

/**
 * Restaurant sales. An order is one bill holding any number of free-typed lines.
 * Totals are always recalculated on the server from the lines; the browser's running
 * total is only a preview.
 *
 * Sales (paid, non-complimentary orders) flow into Financials as income. Kitchen costs
 * are ordinary expenses in the existing "Kitchen & Restaurant" category group, so this
 * page only reads and adds to them rather than keeping a second ledger.
 */
class KitchenController extends Controller
{
    /** The expense categories that count as kitchen costs. */
    public static function expenseCategories(): array
    {
        return array_merge(['Kitchen & Restaurant'], PageController::EXPENSE_CATEGORIES['Kitchen & Restaurant']);
    }

    public function index()
    {
        $orders = KitchenOrder::with('items', 'attachments')->orderByDesc('id')->get();

        $monthStart = now()->startOfMonth()->toDateString();
        $monthEnd = now()->endOfMonth()->toDateString();
        $monthSales = (int) KitchenOrder::sales()->whereBetween('order_date', [$monthStart, $monthEnd])->sum('total');
        $monthCosts = (int) Expense::whereIn('category', self::expenseCategories())->whereBetween('date', [$monthStart, $monthEnd])->sum('amount');

        // Item names typed before, each with the price it last sold at, to speed up entry.
        $suggestions = KitchenOrderItem::orderByDesc('id')->get(['name', 'price'])
            ->unique(fn ($i) => mb_strtolower(trim($i->name)))
            ->take(60)->map(fn ($i) => ['name' => $i->name, 'price' => (int) $i->price])->values();

        return view('kitchen', [
            'orders' => $orders,
            'stats' => [
                'today' => (int) KitchenOrder::sales()->whereDate('order_date', now()->toDateString())->sum('total'),
                'todayOrders' => KitchenOrder::whereDate('order_date', now()->toDateString())->count(),
                'month' => $monthSales,
                'costs' => $monthCosts,
                'profit' => $monthSales - $monthCosts,
                'unpaid' => (int) KitchenOrder::where('payment_status', 'unpaid')->where('type', '!=', 'complimentary')->sum('total'),
            ],
            'kitchenExpenses' => Expense::whereIn('category', self::expenseCategories())->orderByDesc('date')->orderByDesc('id')->take(6)->get(),
            'expenseOptions' => PageController::EXPENSE_CATEGORIES['Kitchen & Restaurant'],
            'cash' => \App\Support\Cashbook::balances(),
            'suggestions' => $suggestions,
        ]);
    }

    public function store(Request $r)
    {
        $data = $this->validated($r);
        $proofs = Attachment::uploaded($r, ['payment_proofs', 'payment_proof'], false, 'payment proof');

        $order = DB::transaction(function () use ($data) {
            $order = KitchenOrder::create([
                'code' => 'KO-TMP-'.uniqid(),
                'customer_name' => $data['customer_name'] ?? null,
                'type' => $data['type'],
                'room_number' => $data['type'] === 'room_guest' ? ($data['room_number'] ?? null) : null,
                'payment_status' => $data['type'] === 'complimentary' ? 'paid' : $data['payment_status'],
                'note' => $data['note'] ?? null,
                'order_date' => $data['order_date'] ?? now()->toDateString(),
                'user_id' => auth()->id(),
            ] + $this->holderChange(null, $data['received_by'] ?? null));
            $order->update(['code' => 'KO-'.str_pad((string) $order->id, 5, '0', STR_PAD_LEFT)]);
            $this->writeLines($order, $data['items']);

            return $order;
        });

        Attachment::attach($proofs, 'kitchen', $order->id);

        return back()->with('ok', 'Order '.$order->code.' saved, PKR '.number_format($order->total).'.');
    }

    public function update(Request $r, $id)
    {
        $order = KitchenOrder::findOrFail($id);
        $data = $this->validated($r);
        $proofs = Attachment::uploaded($r, ['payment_proofs', 'payment_proof'], false, 'payment proof');

        DB::transaction(function () use ($order, $data) {
            $order->update([
                'customer_name' => $data['customer_name'] ?? null,
                'type' => $data['type'],
                'room_number' => $data['type'] === 'room_guest' ? ($data['room_number'] ?? null) : null,
                'payment_status' => $data['type'] === 'complimentary' ? 'paid' : $data['payment_status'],
                'note' => $data['note'] ?? null,
                'order_date' => $data['order_date'] ?? $order->order_date,
            ] + $this->holderChange($order, $data['received_by'] ?? null));
            $order->items()->delete();
            $this->writeLines($order, $data['items']);
        });

        Attachment::detach($r->input('remove_attachments', []), 'kitchen', $order->id);
        Attachment::attach($proofs, 'kitchen', $order->id);

        return back()->with('ok', 'Order '.$order->code.' updated.');
    }

    /**
     * Who received an order's money. Unchanged, or already handed over to the owner,
     * means nothing to change; a non-owner saying the owner received it waits for him.
     */
    private function holderChange(?KitchenOrder $order, $holder): array
    {
        if (! in_array($holder, ['manager', 'owner'], true) || ($order && ($order->handover_id || $order->received_by === $holder))) {
            return [];
        }

        return ['received_by' => $holder, 'owner_confirmed_at' => $holder === 'owner' && auth()->user()->role === 'admin' ? now() : null];
    }

    public function togglePaid($id)
    {
        $order = KitchenOrder::findOrFail($id);
        if ($order->payment_status === 'paid' && $order->handover_id) {
            return back()->with('ok', 'Order '.$order->code.' is part of a handover to the owner. Remove that handover first.');
        }
        $order->update(['payment_status' => $order->payment_status === 'paid' ? 'unpaid' : 'paid']);

        return back()->with('ok', 'Order '.$order->code.' marked '.$order->payment_status.'.');
    }

    public function destroy($id)
    {
        $order = KitchenOrder::findOrFail($id);
        $code = $order->code;
        Attachment::purge('kitchen', $order->id);
        $order->delete();

        return back()->with('ok', 'Order '.$code.' deleted.');
    }

    private function validated(Request $r): array
    {
        return $r->validate([
            'customer_name' => 'nullable|string|max:120',
            'type' => ['required', Rule::in(array_keys(KitchenOrder::TYPES))],
            'room_number' => 'nullable|string|max:30',
            'payment_status' => ['required', Rule::in(['paid', 'unpaid'])],
            'note' => 'nullable|string|max:255',
            'order_date' => 'nullable|date',
            'received_by' => ['nullable', Rule::in(['manager', 'owner'])],
            'items' => 'required|array|min:1|max:60',
            'items.*.name' => 'required|string|max:120',
            'items.*.quantity' => 'required|integer|min:1|max:999',
            'items.*.price' => 'required|integer|min:0|max:1000000',
        ], [
            'items.required' => 'Add at least one item to the order.',
        ]);
    }

    /** Store the lines and set the order total from them. */
    private function writeLines(KitchenOrder $order, array $items): void
    {
        $total = 0;
        foreach ($items as $item) {
            $line = (int) $item['quantity'] * (int) $item['price'];
            $total += $line;
            $order->items()->create([
                'name' => trim($item['name']),
                'quantity' => (int) $item['quantity'],
                'price' => (int) $item['price'],
                'line_total' => $line,
            ]);
        }
        $order->update(['total' => $total]);
    }
}
