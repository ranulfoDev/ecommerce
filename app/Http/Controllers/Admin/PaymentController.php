<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get();
        return view('pages.admin.payments.index', compact('payments'));
    }

    public function verify(Payment $payment)
    {
        $payment->update(['status' => 'verified']);
        return back()->with('success', 'Payment verified!');
    }

    public function refund(Payment $payment)
    {
        $payment->update(['status' => 'refunded']);
        return back()->with('success', 'Refunded!');
    }
}