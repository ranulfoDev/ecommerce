<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('pages.admin.categories.index', compact('categories'));
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255'
    ]);

    Category::create([
        'name' => $request->name
    ]);

    return back()->with('success', 'Category added!');
}


public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|string|max:255'
    ]);

    $category->update([
        'name' => $request->name
    ]);

    return back()->with('success', 'Updated!');
}

public function show(Category $category)
{
    $categories = Category::latest()->get();
   
    return view('pages.admin.categories.show', compact('category', 'categories'));
}

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Deleted!');
    }
}