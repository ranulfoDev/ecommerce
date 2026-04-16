<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();

        return view('pages.user.product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // ✅ ANALYTICS: product view
\DB::table('analytics')->insert([
    'type' => 'view_product',
    'user_id' => auth()->id(),
    'product_id' => $id,
    'created_at' => now(),
    'updated_at' => now()
]);
        return view('pages.user.product.show', compact('product'));
    }

}