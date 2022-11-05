<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Favorite;
use App\Models\Journal;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

class DetailController extends Controller
{
    public function index($slug, $id)
    {
        $user = Auth::user();
        $product = Product::where('id', $id)->where('slug', $slug)->first();
        $favorites = [];

        if ($product) {

            $type = $product->tur;
            $detail = '';

            if ($type === 'journal') {
                $detail = Journal::where('product_id', $product->id)->with('product', 'product.category', 'product.images')->first();
                if ($user)
                    $favorites = Favorite::where('product_id', $detail->product_id)->where('user_id', $user->id)->first();

                return Inertia::render('Frontend/Detail', compact('detail', 'type', 'user', 'favorites'));

            } else if ($type === 'book') {
                $detail = Book::where('product_id', $product->id)->with('product', 'product.category', 'product.images')->first();
                if ($user)
                    $favorites = Favorite::where('product_id', $detail->product_id)->where('user_id', $user->id)->first();

                return Inertia::render('Frontend/Detail', compact('detail', 'type', 'user', 'favorites'));

            } else {
                return Inertia::render('Frontend/NotPage/NotPage');
            }
        } else {
            return Inertia::render('Frontend/NotPage/NotPage');
        }

//        $url = URL::current(); //tıkladığımızda oluşan slug'lı url'ye ulaşmamızı sağlıyor..
//        $exp = explode("/",$url);
//        return $slug = $exp[3];
//        $journals = Journal::all();

    }
}
