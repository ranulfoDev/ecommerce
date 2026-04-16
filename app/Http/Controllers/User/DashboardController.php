<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // SEARCH
        $search = $request->search;

        //  FILTERS
        $category = $request->category;
        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;
        $rating = $request->rating;
        $sort = $request->sort;
     

   // BASE QUERY
$query = Product::with('reviews');

        // SEARCH
        if ($search) {

            // ✅ ANALYTICS: search
   if (\Schema::hasTable('analytics')) {
    \DB::table('analytics')->insert([
        'type' => 'search',
        'user_id' => auth()->id() ?? null,
        'meta' => json_encode(['keyword' => $search]),
        'created_at' => now(),
        'updated_at' => now()
    ]);
}


            $query->where('name', 'like', "%{$search}%");
        }

        // FILTER CATEGORY
        if ($category) {
            $query->where('category_id', $category);
        }

        // FILTER PRICE
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }
 

if ($rating) {
    $query->whereHas('reviews', function ($q) use ($rating) {
        $q->where('rating', '>=', $rating);
    });
}

        // SORTING
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;

            case 'price_high':
                $query->orderBy('price', 'desc');
                break;

            case 'best_selling':
                $query->orderBy('sold', 'desc'); // dapat may column ka na sold
                break;

            default:
                $query->latest();
                break;
        }

        // PAGINATION
        $products = $query->paginate(12)->withQueryString();

        // CATEGORIES
        $categories = Category::all();

        return view('pages.user.dashboard', compact(
            'products',
            'categories',
            'search',
            'category',
            'minPrice',
            'maxPrice',
            'rating',
            'sort'
        ));
    }
}