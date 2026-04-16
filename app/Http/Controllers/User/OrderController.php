<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // View user orders
  public function index()
{
    $orders = Order::where('user_id', Auth::id())
        ->latest()
        ->get();

    return view('pages.user.orders.index', compact('orders'));
}

public function show($id)
{
    $order = Order::where('user_id', Auth::id())
        ->with('items')
        ->findOrFail($id);

    return view('pages.user.orders.show', compact('order'));
}

    // Cancel order
    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($order->status === 'pending') {
            $order->status = 'cancelled';
            $order->save();
        }

        return back()->with('success', 'Order cancelled!');
    }
}