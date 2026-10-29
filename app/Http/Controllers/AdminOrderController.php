<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    private const STATUSES = ['menunggu', 'diproses', 'selesai', 'dibatalkan'];

    public function index(Request $request): View
    {
        $validated = $request->validate([
            'status' => ['nullable', 'in:'.implode(',', self::STATUSES)],
        ]);
        $status = $validated['status'] ?? null;

        $orders = Order::query()
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.orders.index', compact('orders', 'status'));
    }

    public function show(Order $order): View
    {
        $order->load('items');

        return view('admin.orders.show', [
            'order' => $order,
            'statuses' => self::STATUSES,
            'paymentStatuses' => ['menunggu', 'terbayar', 'ditolak'],
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:'.implode(',', self::STATUSES)],
            'payment_status' => ['required', 'in:menunggu,terbayar,ditolak'],
        ]);
        $order->update($validated);

        return back()->with('ok', 'Status pesanan berhasil diperbarui.');
    }
}
