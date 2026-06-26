<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wilaya;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cartData = $request->query('cart');

        if ($cartData) {
            $cart = json_decode(base64_decode($cartData), true);
        } else {
            $cart = session()->get('cart', []);
        }

        if (empty($cart)) {
            return redirect()->route('home');
        }

        $wilayas = Wilaya::all();
        $subtotal = 0;
        foreach ($cart as &$item) {
            $p = Product::find($item['id']);
            if ($p) {
                $item['title'] = $p->title;
                $item['price'] = (float) $p->price;
                $item['image'] = $p->image_path;
            }
            $subtotal += $item['price'] * $item['qty'];
        }

        $cartJson = json_encode($cart);

        return view('checkout', compact('cart', 'wilayas', 'subtotal', 'cartJson'));
    }

    public function getDeliveryPrice(Request $request)
    {
        $wilaya = Wilaya::find($request->wilaya_id);
        if (!$wilaya) return response()->json(['price' => 0]);

        $price = $request->delivery_type === 'home'
            ? $wilaya->home_delivery_price
            : $wilaya->stopdesk_price;

        return response()->json(['price' => (float) $price]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'wilaya_id' => 'required|exists:wilayas,id',
            'delivery_type' => 'required|in:home,stopdesk',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'note' => 'nullable|string|max:500',
            'cart_data' => 'required|json',
        ], [
            'wilaya_id.required' => 'الرجاء اختيار الولاية',
            'delivery_type.required' => 'الرجاء اختيار نوع التوصيل',
            'full_name.required' => 'الاسم الكامل مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'cart_data.required' => 'السلة فارغة',
        ]);

        $cart = json_decode($request->cart_data, true);
        if (empty($cart)) return redirect()->route('home');

        $wilaya = Wilaya::find($request->wilaya_id);
        $deliveryPrice = $request->delivery_type === 'home'
            ? $wilaya->home_delivery_price
            : $wilaya->stopdesk_price;
        $deliveryTypeText = $request->delivery_type === 'home' ? 'توصيل إلى المنزل' : 'تسليم في المحطة';

        $subtotal = 0;
        $itemsText = '';
        foreach ($cart as $item) {
            $lineTotal = $item['price'] * $item['qty'];
            $subtotal += $lineTotal;
            $itemsText .= "- {$item['title']} × {$item['qty']} = {$lineTotal} دج\n";
        }
        $total = $subtotal + $deliveryPrice;

        $msg = "السلام عليكم، أريد طلب:\n" . $itemsText;
        $msg .= "\nالمجموع الفرعي: {$subtotal} دج";
        $msg .= "\nالتوصيل ({$deliveryTypeText}): {$deliveryPrice} دج";
        $msg .= "\nالمجموع الكلي: {$total} دج";
        $msg .= "\n\n── معلومات العميل ──";
        $msg .= "\nالاسم: {$request->full_name}";
        $msg .= "\nالهاتف: {$request->phone}";
        $msg .= "\nالولاية: {$wilaya->name}";
        $msg .= "\nنوع التوصيل: {$deliveryTypeText}";
        if ($request->note) $msg .= "\nملاحظة: {$request->note}";

        $phone = "213552631891";
        $waUrl = "https://wa.me/{$phone}?text=" . urlencode($msg);

        return redirect()->away($waUrl);
    }
}
