<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class ReportController extends Controller
{
public function index()
{
    $from = request('from');
    $to = request('to');

    // 👉 BASE QUERY
    $ordersQuery = Order::query()
        ->when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('created_at', [$from, $to]);
        });

    // 👉 MAIN STATS
    $totalSales = (clone $ordersQuery)->sum('total');
    $orders = (clone $ordersQuery)->count();

    // 👉 TODAY STATS
    $todayQuery = Order::whereDate('created_at', today())
        ->when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('created_at', [$from, $to]);
        });

    $todayOrders = (clone $todayQuery)->count();
    $todaySales = (clone $todayQuery)->sum('total');

    // 👉 MONTHLY SALES (OPTIMIZED)
    $monthlySales = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total')
        ->when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('created_at', [$from, $to]);
        })
        ->groupBy('month')
        ->pluck('total', 'month');

    // 👉 TOP PRODUCTS (FAST VERSION 🔥 NO withCount)
    $topProducts = Product::select('products.name')
        ->join('order_items', 'products.id', '=', 'order_items.product_id')
        ->when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('order_items.created_at', [$from, $to]);
        })
        ->selectRaw('COUNT(order_items.id) as total_sold')
        ->groupBy('products.id', 'products.name')
        ->orderByDesc('total_sold')
        ->limit(5)
        ->get();

    return view('pages.admin.reports.index', compact(
        'totalSales',
        'orders',
        'todayOrders',
        'todaySales',
        'monthlySales',
        'topProducts',
        'from',
        'to'
    ));
}
}