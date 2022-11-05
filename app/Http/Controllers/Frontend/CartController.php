<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    public function cart()
    {
        $user = Auth::user();
        $sessions = [];
        $carts = [];
        $totalPrice = 0.0;
        $session_total_price = 0.0;
        if (Auth::user()) {
            $user = Auth::user();
            $carts = Cart::where('user_id', $user->id)->with('product')->get();
            foreach ($carts as $cart) {
                $cart->sum_prod = number_format($cart->product->price != null ? $cart->product->price * $cart->count : $cart->product->old_price * $cart->count,2, ',', '.');
                $totalPrice += $cart->product->price != null ? $cart->product->price * $cart->count : $cart->product->old_price * $cart->count;

            }
        } else {
            $sessions = session('cart.products');
            $session_total_price = session('cart.total_price');
        }
        $totalPrice = number_format($totalPrice,2, ',', '.');

//        return $session_total_price;
//        return session()->all();
        return Inertia::render('Frontend/Cart', compact('user', 'sessions', 'carts', 'totalPrice', 'session_total_price'));
    }

    public function checkout()
    {
        $user = [];
        $carts = [];
        $addresses = [];
        $totalPrice = 0.0;
        if (Auth::user()) {
            $user = Auth::user();
            $carts = Cart::where('user_id', $user->id)->with('product')->get();
            $addresses = Address::where('user_id', $user->id)->get();
            foreach ($carts as $cart) {
                $cart->sum_prod = number_format($cart->product->price != null ? $cart->product->price * $cart->count : $cart->product->old_price * $cart->count,2, ',', '.');
                $totalPrice += $cart->product->price != null ? $cart->product->price * $cart->count : $cart->product->old_price * $cart->count;
            }
            $totalPrice = number_format($totalPrice,2, ',', '.');
            return Inertia::render('Frontend/Checkout', compact('user', 'carts', 'totalPrice', 'addresses'));
        } else {
            return Inertia::render('Frontend/NotPage/NotPage');
//            return "Bu sayfa kullanılamamaktadır..";
        }

    }

    public function add($product_id)
    {
//        return $product_id;
//        return session('cart.products');
//        return $product_id = session()->all();
//        return $product_id = session()->get('product');
//        return $product_id = session()->all();
//        return $data = Cart::where('user_id', $user_id)->get();
        $product = Product::find($product_id);
        if (Auth::user()) {
            $user_id = Auth::user()->getAuthIdentifier(); //bu fonkiyon id yi veriyor
            $carts = Cart::where('user_id', $user_id)->get();
            $sayac = 0;
            if (count($carts) != 0) {
                foreach ($carts as $cart) {
                    if ($product_id == $cart->product_id) {
                        $sayac++;
                        $singleCart = Cart::where('product_id', $product_id)->where('user_id', $user_id)->first();
                        $singleCart->count++;
//                        $singleCart->total_price += $product->price !== null ? $product->price : $product->old_price ;
                        $singleCart->save();
                    }
                }
                if ($sayac == 0) {
                    Cart::create([
                        'user_id' => $user_id,
                        'product_id' => $product_id,
                        'count' => 1,
//                        'total_price' => $product->price !== null ? $product->price : $product->old_price
                    ]);
                }
            } else {
                Cart::create([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'count' => 1,
//                    'total_price' => $product->price != null ? $product->price : $product->old_price
                ]);
            }
        }
        else {
//            $product = session()->put('selami', 'aha');
            if (!empty(session('cart'))) {
                $shoppingCart = session('cart');
                $products = $shoppingCart['products'];
            } else {
                $products = [];
            }
            if (array_key_exists($product_id, $products)) {
                $products[$product_id]['qty'] += 1;
            } else {
                $products[$product_id] = $product;
                $products[$product_id]['qty'] = 1;
            }
            $total_qty = 0;
            $total_price = 0.0;
            $fiyat = 0;
            foreach ($products as $key => $value) {

                if ($value['price'] != null){
                    $fiyat = $value['qty'] * $value['price'];
                    $products[$key]['total_price'] = number_format($fiyat,2,',','.');
                } else {
                    $fiyat = $value['qty'] * $value['old_price'];
                    $products[$key]['total_price'] = number_format($fiyat,2,',','.');
//                    $products[$key]['total_price'] = $value['qty'] * number_format($value['old_price'],2,'.','');
                }
//                $products[$key]['total_price'] = $value['qty'] * $value['price'] == null ? $value['old_price'] : $value['price'];
//                $products[$key]['total_price'] = $value['qty'] * $value['old_price'];
//                return $total_price;
                $total_price += $fiyat;
                $total_qty = $total_qty + $value['qty'];
            }
            $total_price = number_format($total_price,2, ',', '.');
            session()->put('cart.products', $products);
            session()->put('cart.total', $total_qty);
            session()->put('cart.total_price', $total_price);
        }

    }

    public function plus($cart_id)
    {
        if (Auth::user()) {
            $cart = Cart::where('id', $cart_id)->with('product')->first();
            $cart->count++;
//            $cart->total_price += $cart->product->price != null ? $cart->product->price : $cart->product->old_price;
            $cart->save();
        }
        else {
            $sessions = session('cart.products');
            $sessions[$cart_id]->qty++;
//            $sessions[$cart_id]->total_price += $sessions[$cart_id]->price != null ? $sessions[$cart_id]->price : $sessions[$cart_id]->old_price;

            $total_qty = 0;
            $total_price = 0.0;
            $fiyat = 0;

            foreach ($sessions as $key => $value) {
//                $total_qty = $total_qty + $value['qty'];
//                $total_price += $value['qty'] * $value['price'] != null ? $value['price'] : $value['old_price'];
                if ($value['price'] != null){
                    $fiyat = $value['qty'] *$value['price'];
                    $sessions[$key]['total_price'] = number_format($fiyat,2,',','.');
                } else {
                    $fiyat = $value['qty'] *$value['old_price'];
                    $sessions[$key]['total_price'] = number_format($fiyat,2,',','.');
                }
                $total_price += $fiyat;
                $total_qty = $total_qty + $value['qty'];
            }
            $total_price = number_format($total_price,2, ',', '.');
            session()->put('cart.total', $total_qty);
            session()->put('cart.total_price', $total_price);
        }
    }

    public function minus($cart_id)
    {
        if (Auth::user()) {
            $cart = Cart::where('id', $cart_id)->with('product')->first();
            $cart->count--;
//            $cart->total_price -= $cart->product->price != null ? $cart->product->price : $cart->product->old_price;
            if ($cart->count == 0) {
                $this->remove($cart_id);
            }
            $cart->save();
        }
        else {
            $sessions = session('cart.products');
            $sessions[$cart_id]->qty--;
//            $sessions[$cart_id]->total_price -= $sessions[$cart_id]->price != null ? $sessions[$cart_id]->price : $sessions[$cart_id]->old_price;

            if ($sessions[$cart_id]->qty == 0){
                $this->remove($cart_id);
            }

            $total_qty = 0;
            $total_price = 0.0;
            $fiyat = 0;
            foreach ($sessions as $key => $value) {
//                $total_qty = $total_qty + $value['qty'];
//                $total_price += $value['qty'] * $value['price'] != null ? $value['price'] : $value['old_price'];
                if ($value['price'] != null){
                    $fiyat = $value['qty'] *$value['price'];
                    $sessions[$key]['total_price'] = number_format($fiyat,2,',','.');
                } else {
                    $fiyat = $value['qty'] *$value['old_price'];
                    $sessions[$key]['total_price'] = number_format($fiyat,2,',','.');
                }
                $total_price += $fiyat;
                $total_qty = $total_qty + $value['qty'];
            }
            $total_price = number_format($total_price,2, ',', '.');
            session()->put('cart.total', $total_qty);
            session()->put('cart.total_price', $total_price);
        }
    }

    public function remove($cart_id)
    {
        if (Auth::user()) {
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        else {

            session()->pull('cart.products.'.$cart_id);
            $sessions = session('cart.products');
            $total_qty = 0;
            $total_price = 0.0;
            $fiyat = 0;
            foreach ($sessions as $key => $value) {
                if ($value['price'] != null){
                    $fiyat = $value['qty'] *$value['price'];
                    $sessions[$key]['total_price'] = number_format($fiyat,2,',','.');
                } else {
                    $fiyat = $value['qty'] *$value['old_price'];
                    $sessions[$key]['total_price'] = number_format($fiyat,2,',','.');
                }
                $total_price += $fiyat;
                $total_qty = $total_qty + $value['qty'];
            }
            $total_price = number_format($total_price,2, ',', '.');
            session()->put('cart.total', $total_qty);
            session()->put('cart.total_price', $total_price);
        }
    }
}
