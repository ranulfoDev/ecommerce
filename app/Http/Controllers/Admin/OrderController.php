<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('pages.admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('pages.admin.orders.show', compact('order'));
    }

    // UPDATE STATUS
   public function updateStatus(Order $order, $status)
{
    $order->update(['status' => $status]);

    // 🔥 AUTO DEDUCT STOCK kapag COMPLETED
    if ($status === 'completed') {
        foreach ($order->items as $item) {
            $product = $item->product;

            if ($product) {
                $product->stock -= $item->quantity;
                $product->save();
            }
        }
    }

    return back()->with('success', 'Status updated!');
}

    // CANCEL ORDER
    public function cancel(Order $order)
    {
        $order->update(['status' => 'cancelled']);
        return back()->with('success', 'Order cancelled!');
    }
}
