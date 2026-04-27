<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('pages.admin.coupons.index', compact('coupons'));
    }

  public function store(Request $request)
{
$request->validate([
    'code' => 'required',
    'discount' => 'required|numeric',
]);

Coupon::create([
    'code' => strtoupper($request->code),
    'discount' => $request->discount,
    'expires_at' => $request->expires_at,
]);

    return back()->with('success', 'Coupon created!');
}

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back()->with('success', 'Deleted!');
    }
}
