<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment; // ✅ IMPORTANT
use App\Models\Coupon;

class CheckoutController extends Controller
{
    public function index()
    {
        \DB::table('analytics')->insert([
            'type'       => 'visit_checkout',
            'user_id'    => auth()->id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $cart  = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('pages.user.checkout.index', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'address'        => 'required',
            'payment_method' => 'required'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('user.cart')
                ->with('error', 'Your cart is empty.');
        }
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

/* =========================
   COUPON LOGIC (INSERT HERE)
========================= */
$discount = 0;

if ($request->coupon_code) {
    $coupon = Coupon::where('code', $request->coupon_code)->first();

    if (!$coupon) {
        return back()->with('error', 'Invalid coupon');
    }

    if ($coupon->expires_at && $coupon->expires_at < now()) {
        return back()->with('error', 'Coupon expired');
    }

    // compute discount
    $discount = $total * ($coupon->discount / 100);
    $total -= $discount;
}

// 🔥 COUPON LOGIC HERE

$discount = 0; // 🔥 IMPORTANT - default

if ($request->coupon_code) {
    $coupon = Coupon::where('code', $request->coupon_code)->first();

    if ($coupon && (!$coupon->expires_at || $coupon->expires_at >= now())) {
        $discount = $total * ($coupon->discount / 100);
        $total -= $discount;
    }
}


        // ✅ CREATE ORDER
        $order = Order::create([
            'user_id'        => auth()->id(),
            'name'           => $request->name,
            'address'        => $request->address,
            'payment_method' => $request->payment_method,
            'total'          => $total,
            'status'         => 'pending',
            'coupon_code'    => $request->coupon_code,
            'discount_amount'=> $discount,
            'total'          => $total
        ]);

        // ✅ CREATE PAYMENT (COD or fallback)
        Payment::create([
            'order_id' => $order->id,
            'amount'   => $total,
            'method'   => $request->payment_method,
            'status'   => 'pending',
        ]);

        // ✅ SAVE ITEMS
        foreach ($cart as $item) {
            $order->items()->create([
                'product_id'   => $item['id'],
                'product_name' => $item['name'],
                'price'        => $item['price'],
                'quantity'     => $item['quantity'],
            ]);
        }

        \DB::table('analytics')->insert([
            'type'       => 'order_placed',
            'user_id'    => auth()->id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        session()->forget('cart');

        return redirect()->route('user.orders')
            ->with('success', 'Order placed successfully!');
    }

    // ✅ ADD THIS METHOD (PAYPAL)
    public function paypalOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json(['success' => false]);
        }

        $total = $request->amount;

        // ✅ CREATE ORDER
        $order = Order::create([
            'user_id'        => auth()->id(),
            'name'           => $request->name,
            'address'        => $request->address,
            'payment_method' => 'paypal',
            'total'          => $total,
            'status'         => 'pending',
         
        ]);

        // ✅ SAVE ITEMS
        foreach ($cart as $item) {
            $order->items()->create([
                'product_id'   => $item['id'],
                'product_name' => $item['name'],
                'price'        => $item['price'],
                'quantity'     => $item['quantity'],
            ]);
        }

        // ✅ CREATE PAYMENT (PAYPAL)
        Payment::create([
            'order_id'       => $order->id,
            'amount'         => $total,
            'method'         => 'paypal',
            'status'         => 'verified',
            'transaction_id' => $request->transaction_id,
            'payer_email'    => $request->payer_email,
        ]);

        session()->forget('cart');

        return response()->json(['success' => true]);
    }
}