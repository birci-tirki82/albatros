<?php
namespace App\Repositories;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartRepository implements CartRepositoryInterface
{
//    public function getAll(){
//        return Cart::all();
//    }
//    public function getPost($id){
//        return Cart::findOrFail($id);
//    }
    // more
//    public function cart()
//    {
//        // TODO: Implement cart() method.
//    }
//
//    public function checkout()
//    {
//        // TODO: Implement checkout() method.
//    }

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
