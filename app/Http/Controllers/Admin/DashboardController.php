<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;


class DashboardController extends Controller
{
public function index()
{
    $filter = request('filter', '7days');

    if ($filter === 'today') {
        $salesData = Order::whereDate('created_at', today())
            ->selectRaw('HOUR(created_at) as label, SUM(total) as total')
            ->groupBy('label')
            ->orderBy('label')
            ->get();
    } elseif ($filter === 'monthly') {
        $salesData = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as label, SUM(total) as total')
            ->groupBy('label')
            ->orderBy('label')
            ->get();
    } else {
        $salesData = Order::selectRaw('DATE(created_at) as label, SUM(total) as total')
            ->groupBy('label')
            ->orderBy('label')
            ->take(7)
            ->get();
    }

    // ✅ DITO MO ININSERT
    $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $months = collect(range(1, 12))->map(function ($m) use ($monthlySales) {
        $found = $monthlySales->firstWhere('month', $m);

        return [
            'label' => date('M', mktime(0, 0, 0, $m, 1)),
            'total' => $found ? $found->total : 0
        ];
    });

// 🔥 ORDER STATUS
$pendingOrders = Order::where('status', 'pending')->count();
$completedOrders = Order::where('status', 'completed')->count();

// 📦 INVENTORY ALERT
$lowStockProducts = Product::where('stock', '<', 5)->get();

// 📈 GROWTH
$thisYearSales = Order::whereYear('created_at', now()->year)->sum('total');
$lastYearSales = Order::whereYear('created_at', now()->subYear()->year)->sum('total');

$growth = $lastYearSales > 0 
    ? (($thisYearSales - $lastYearSales) / $lastYearSales) * 100 
    : 0;

// 🔥 TOP SELLING PRODUCTS
$topProducts = Product::withSum('orderItems as total_sold', 'quantity')
    ->orderByDesc('total_sold')
    ->limit(5)
    ->get();
// 🛒 ORDERS PER MONTH
$ordersPerMonth = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    ->groupBy('month')
    ->orderBy('month')
    ->get();



    return view('pages.admin.dashboard', [
        'title' => 'Dashboard',
        'totalUsers' => User::count(),
        'totalOrders' => Order::count(),
        'totalSales' => Order::sum('total'),
        'products' => Product::latest()->limit(5)->get(),
        'recentUsers' => User::latest()->limit(5)->get(),
        'salesData' => $salesData,
        'monthlySales' => $months, // ✅ ADD MO TO
        'filter' => $filter,
        'pendingOrders' => $pendingOrders,
        'completedOrders' => $completedOrders,
        'lowStockProducts' => $lowStockProducts,
        'growth' => round($growth, 2),
        'topProducts' => $topProducts,
        'ordersPerMonth' => $ordersPerMonth,
    ]);
}
}
