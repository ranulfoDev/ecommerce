<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class CartController extends Controller
{

  public function index()
{
    $cart = session()->get('cart', []);
    return view('pages.user.cart.index', compact('cart'));
}

public function add(Request $request)
{
   $product = Product::findOrFail($request->id);

// ✅ ANALYTICS: add to cart
\DB::table('analytics')->insert([
    'type' => 'add_to_cart',
    'user_id' => auth()->id(),
    'product_id' => $product->id,
    'created_at' => now(),
    'updated_at' => now()
]);


    $cart = session()->get('cart', []);

    if(isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        $cart[$product->id] = [
            "id" => $product->id,
            "name" => $product->name,
            "price" => $product->price,
            "image" => $product->image ?? 'https://via.placeholder.com/60',
            "quantity" => 1
        ];
    }

    session()->put('cart', $cart);

    return back()->with('success','Added to cart');
}

public function update(Request $request)
{
    $cart = session()->get('cart', []);

    if(isset($cart[$request->id])) {
        $cart[$request->id]['quantity'] = $request->quantity;
    }

    session()->put('cart', $cart);

    return back();
}

public function remove(Request $request)
{
    $cart = session()->get('cart', []);

    unset($cart[$request->id]);

    session()->put('cart', $cart);

    return back();
}

}