<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // TOTAL COUNTS
        $views = DB::table('analytics')->where('type', 'view_product')->count();
        $cart = DB::table('analytics')->where('type', 'add_to_cart')->count();
        $orders = DB::table('analytics')->where('type', 'order_placed')->count();
        $checkout = DB::table('analytics')->where('type', 'visit_checkout')->count();

        // TOP SEARCHES
        $searches = DB::table('analytics')
            ->where('type', 'search')
            ->select('meta', DB::raw('count(*) as total'))
            ->groupBy('meta')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
        
        // 📊 Orders per day (last 7 days)
       $ordersChart = DB::table('analytics')
          ->where('type', 'order_placed')
          ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
          ->groupBy('date')
          ->orderBy('date')
          ->get();
        
  
        // SALES CHART
$salesChart = DB::table('orders')
    ->selectRaw('DATE(created_at) as date, SUM(total) as total')
    ->groupBy('date')
    ->orderBy('date')
    ->get();


// TOP PRODUCTS
$topProducts = DB::table('order_items')
    ->join('products', 'order_items.product_id', '=', 'products.id')
    ->select('products.name', DB::raw('COUNT(*) as total'))
    ->groupBy('products.name')
    ->orderByDesc('total')
    ->limit(5)
    ->get();


// MONTHLY REVENUE
$monthlyRevenue = DB::table('orders')
    ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
    ->groupBy('month')
    ->orderBy('month')
    ->get();

        return view('pages.user.analytics.index', compact(
            'views',
            'cart',
            'orders',
            'checkout',
            'searches',
            'ordersChart',
            'salesChart',
            'topProducts',
            'monthlyRevenue'
        ));
    }
}
