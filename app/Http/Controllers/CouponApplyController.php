<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponApplyController extends Controller
{
    public function apply(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return response()->json(['error' => 'Invalid coupon']);
        }

        if ($coupon->expires_at && $coupon->expires_at < now()) {
            return response()->json(['error' => 'Expired coupon']);
        }

        return response()->json([
            'success' => true,
            'discount' => $coupon->discount,
            'message' => 'Coupon applied successfully'
        ]);
    }
}