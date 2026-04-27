<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class PayPalCallbackController extends Controller
{
    public function callback(Request $request)
    {
        $data = $request->all();

        // Find or create order
        $order = Order::find($data['order_id'] ?? null);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        // ✅ CREATE PAYMENT RECORD
        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => $data['amount'],
            'method' => 'paypal',
            'status' => 'pending', // Admin will verify later
            'transaction_id' => $data['order_id'], // PayPal order ID
            'payer_email' => $data['payer_email']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment recorded. Waiting for admin verification.',
            'payment_id' => $payment->id
        ]);
    }
}