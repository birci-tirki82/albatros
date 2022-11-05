<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Journal;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $books = Book::with( 'product')
            ->with( 'writer' , function($query) { $query->withTrashed(); })
            ->with( 'publisher' , function($query) { $query->withTrashed(); })
            ->whereHas('product' , function($query) { $query->where('is_active', 1)->where('stok', '>', 0); })
            ->with( 'product.category')
            ->limit(4)
            ->get();
        $journals = Journal::with( 'product')
            ->with( 'publisher' , function($query) { $query->withTrashed(); })
            ->whereHas('product' , function($query) { $query->where('is_active', 1)->where('stok', '>', 0); })
            ->with( 'product.category')
            ->limit(4)
            ->get();


//        $products = Product::where('is_active', 1)->get();
//        foreach ($products as $product) {
//            if ($product->tur == 'book') {
//                $books[] = Book::where('product_id', $product->id)->with('product.category')->with('product', 'writer')->first();
//            } else if ($product->tur == 'journal'){
//                $journals[] = Journal::where('product_id', $product->id)->with('product.category')->with('product')->first();
//            }
//        }
//       $books = array_splice($books, 0, 4);
//       $journals = array_splice($journals, 0, 4);
//        return $books;
//        $books = Book::with('product.category')->with('product')->limit(4)->get();
        $cats = Category::all();

        return Inertia::render('Frontend/Home', compact('user', 'journals', 'books', 'cats'));
    }

    public function loginFront()
    {
        if (Auth::user()) {
            return redirect()->to("/");
        } else {
            return Inertia::render('Frontend/Login');
        }
    }

    public function registerFront()
    {
        if (Auth::user()) {
            return redirect()->to("/");
        } else {
            return Inertia::render('Frontend/Register');
        }
    }
}
