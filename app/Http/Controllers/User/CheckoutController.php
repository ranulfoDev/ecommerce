<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function index()
    {
        // ✅ ANALYTICS
        \DB::table('analytics')->insert([
            'type' => 'visit_checkout',
            'user_id' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // ✅ GET CART FROM SESSION
        $cart = session()->get('cart', []);

        // ✅ COMPUTE TOTAL
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('pages.user.checkout.index', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        // ✅ VALIDATION
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'payment_method' => 'required'
        ]);

        // ✅ ANALYTICS
        \DB::table('analytics')->insert([
            'type' => 'order_placed',
            'user_id' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // OPTIONAL: clear cart after order
        session()->forget('cart');

        return redirect()->route('user.orders')
            ->with('success','Order placed successfully');
    }
}