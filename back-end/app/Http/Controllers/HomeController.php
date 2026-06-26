<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::with('category')
            ->latest()
            ->get();
        
        return view('home', compact('categories', 'products'));
    }

    public function categoryProducts($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::with('category')
            ->where('category_id', $id)
            ->latest()
            ->get();
        $categories = Category::withCount('products')->get();

        return view('category-products', compact('category', 'products', 'categories'));
    }
}
