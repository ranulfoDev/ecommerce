<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->paginate(10);
        return view('pages.admin.payments.index', compact('payments'));
    }

    public function verify(Payment $payment)
    {
        // ✅ Update payment
        $payment->update(['status' => 'verified']);
        
        // ✅ Update related order
        if ($payment->order) {
            $payment->order->update([
                'payment_status' => 'paid',
                'status' => 'processing' // optional (order status)
            ]);
        }
        
        return back()->with('success', 'Payment verified!');
    }

    public function refund(Payment $payment)
    {
        // ✅ Update payment
        $payment->update(['status' => 'refunded']);
        
        // ✅ Update related order
        if ($payment->order) {
            $payment->order->update([
                'payment_status' => 'refunded',
                'status' => 'cancelled' // optional
            ]);
        }
        
        return back()->with('success', 'Refunded!');
    }
}