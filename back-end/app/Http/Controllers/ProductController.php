<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        
        $similarProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->available()
            ->limit(4)
            ->get();
        
        return view('details', compact('product', 'similarProducts'));
    }
}
