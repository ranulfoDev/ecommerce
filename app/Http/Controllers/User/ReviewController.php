<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable'
        ]);

        Review::create([
            'user_id' => auth()->id(), // 🔥 importante
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'approved' => false
        ]);

        return back()->with('success', 'Review submitted!');
    }
}