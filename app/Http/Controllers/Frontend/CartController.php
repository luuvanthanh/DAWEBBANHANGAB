<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function getCart(Request $request)
    {
        return view('frontend.cart.cart');
    }

    public function postCart(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        $cartItem = [
            'id' => $id,
            'name' => $product->name, 
            'image' => $product->image, 
            'price' => $product->price,
            'user_id' => $product->user_id,
            'quantity' => 1
        ];
        $cart = session()->get('cart');
        if (empty($cart)) {
            $cart[$id] = $cartItem;
        }else {
            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
                $cart[$id]['price'] = $cart[$id]['price'] * $cart[$id]['quantity'];
            }else {
                $cart[$id] = $cartItem;
            }
        }
        
        session()->put('cart', $cart);
        return response()->json([
            'success' => 'Cập nhật giỏ hàng thành công',
        ]);
        // session()->forget('cart');
    }

    public function UpQuantity(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        if (!empty($cart)) {
            $cart[$id]['quantity']++;
        }
        session()->put('cart', $cart);
        return response()->json([
            'success' => 'Cập nhật số lượng thành công',
        ]);
    }
    public function DownQuantity(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        if (!empty($cart)) {
            $cart[$id]['quantity']--;
            if ($cart[$id]['quantity'] < 1) {
                unset($cart[$id]);
            }
        }
        session()->put('cart', $cart);
        return response()->json([
            'success' => 'Cập nhật số lượng thành công',
        ]);
    }

    public function DeleteCart(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        if (!empty($cart)) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
        return response()->json([
            'success' => 'Cập nhật số lượng thành công',
        ]);
    }
}
