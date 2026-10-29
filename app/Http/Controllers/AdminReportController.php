<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminReportController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'month' => ['nullable', 'date_format:Y-m'],
        ]);
        $month = Carbon::createFromFormat('Y-m', $validated['month'] ?? now()->format('Y-m'))
            ->startOfMonth();
        $start = $month->copy();
        $end = $month->copy()->endOfMonth();
        $orders = Order::whereBetween('created_at', [$start, $end]);

        $topProducts = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween('orders.created_at', [$start, $end])
            ->where('orders.status', '!=', 'dibatalkan')
            ->select('order_items.name')
            ->selectRaw('SUM(order_items.qty) as quantity, SUM(order_items.price * order_items.qty) as gross_sales')
            ->groupBy('order_items.name')
            ->orderByDesc('quantity')
            ->limit(10)
            ->get();

        return view('admin.reports.index', [
            'month' => $month,
            'ordersCount' => (clone $orders)->count(),
            'revenue' => (clone $orders)->where('status', '!=', 'dibatalkan')->sum('total'),
            'pendingCount' => (clone $orders)->where('status', 'menunggu')->count(),
            'completedCount' => (clone $orders)->where('status', 'selesai')->count(),
            'topProducts' => $topProducts,
            'statusCounts' => (clone $orders)->select('status')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('status')
                ->pluck('total', 'status'),
        ]);
    }
}
