<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query || strlen(trim($query)) < 1) {
            return response()->json([]);
        }
        
        $products = Product::with('category')
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('author', 'like', "%{$query}%");
            })
            ->available()
            ->limit(10)
            ->get();
        
        return response()->json($products);
    }
}
