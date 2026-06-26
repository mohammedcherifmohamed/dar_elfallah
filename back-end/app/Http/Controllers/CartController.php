<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as &$item) {
            $product = Product::find($item['id']);
            if ($product) {
                $item['title'] = $product->title;
                $item['price'] = (float) $product->price;
                $item['image'] = $product->image_path;
            }
            $total += $item['price'] * $item['qty'];
        }
        
        return response()->json([
            'items' => $cart,
            'total' => $total,
            'count' => array_sum(array_column($cart, 'qty')),
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'integer|min:1|max:99',
        ]);
        
        $product = Product::findOrFail($request->product_id);
        $qty = $request->qty ?: 1;
        
        $cart = session()->get('cart', []);
        
        $found = false;
        foreach ($cart as &$item) {
            if ($item['id'] == $product->id) {
                $item['qty'] += $qty;
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $cart[] = [
                'id' => $product->id,
                'title' => $product->title,
                'price' => (float) $product->price,
                'qty' => $qty,
                'image' => $product->image_path,
            ];
        }
        
        session()->put('cart', $cart);
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }
        
        return response()->json([
            'items' => $cart,
            'total' => $total,
            'count' => array_sum(array_column($cart, 'qty')),
            'message' => 'تمت إضافة الكتاب إلى السلة',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['qty' => 'required|integer|min:1|max:99']);
        
        $cart = session()->get('cart', []);
        
        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                $item['qty'] = $request->qty;
                break;
            }
        }
        
        session()->put('cart', $cart);
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }
        
        return response()->json([
            'items' => $cart,
            'total' => $total,
            'count' => array_sum(array_column($cart, 'qty')),
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        $cart = array_filter($cart, function($item) use ($id) {
            return $item['id'] != $id;
        });
        
        session()->put('cart', array_values($cart));
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }
        
        return response()->json([
            'items' => array_values($cart),
            'total' => $total,
            'count' => array_sum(array_column($cart, 'qty')),
        ]);
    }

    public function clear()
    {
        session()->forget('cart');
        
        return response()->json([
            'items' => [],
            'total' => 0,
            'count' => 0,
        ]);
    }
}
