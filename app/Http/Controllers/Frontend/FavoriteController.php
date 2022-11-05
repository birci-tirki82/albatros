<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FavoriteController extends Controller
{

    public function favorite()
    {
        $user = Auth::user();
        $favorites = [];
        if (Auth::user()) {
            $user = Auth::user();
            $favorites = Favorite::where('user_id', $user->id)->with('product')->get();
            return Inertia::render('Frontend/Favorite', compact('user', 'favorites'));
        } else {
            return Inertia::render('Frontend/Login');
        }

    }

    public function add($product_id)
    {
//        return $product_id;
        if (Auth::user()) {
            $user_id = Auth::user()->getAuthIdentifier(); //bu fonkiyon id yi veriyor
            $favorites = Favorite::where('user_id', $user_id)->get();
            $sayac = 0;
            if (count($favorites) != 0) {
                foreach ($favorites as $favorite) {
                    if ($product_id == $favorite->product_id) {
                        $sayac++;
                        $this->remove($favorite->id);
                    }
                }
                if ($sayac == 0) {
                    Favorite::create([
                        'user_id' => $user_id,
                        'product_id' => $product_id,
                    ]);
                }
            } else {
                Favorite::create([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                ]);
            }
        }
    }

    public function remove($favorite_id)
    {
        if (Auth::user()) {
            $cart = Favorite::find($favorite_id);
            $cart->delete();
        }
    }
}
