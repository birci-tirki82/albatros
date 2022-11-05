<?php
namespace App\Repositories;
use App\Models\Cart;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteRepository implements CartRepositoryInterface
{

    public function remove($favorite_id)
    {
        if (Auth::user()) {
            $cart = Favorite::find($favorite_id);
            $cart->delete();
        }
    }
}
