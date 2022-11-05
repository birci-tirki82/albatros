<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Journal;
use App\Models\Product;
use App\Models\Publisher;
use App\Models\Writer;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class ProductsController extends Controller
{

    protected $as = [];

    public function categoryProducts($cat)
    {
//return 1;
        $products = [];
        $subCats = [];
        $category = Category::where('slug', $cat)->first();

        if ($category) {
            $subCats = Category::where('parent_id', $category->id)->get();
            $this->as[] = $category->id;
            $tur = $category->tur;
        } else {
            return Inertia::render('Frontend/NotPage/NotPage');
        }

        $prods = Product::all();
        $allCategories = Category::all();

        self::formatTree($subCats, $allCategories, $prods);

        $data = Product::whereIn('category_id', $this->as)
            ->where('is_active', 1)
            ->where('stok', '>', 0)
            ->get();
//        return $data;

        if ($tur == 'book') {
            foreach ($data as $value) {
                //Aşağıki satırda product tablosunda is_active alanı sıfır olanları null değerine eşitledik. ve aşağıdaki if te product null ise onu diziye atmadık..
              $products[] = Book::where('product_id', $value->id)
                  ->with('product')
                  ->with('publisher' , function($query) { $query->withTrashed(); })
                  ->with('writer' , function($query) { $query->withTrashed(); })
                  ->first();
//                $pro = Book::where('product_id', $value->id)->with(['product' => function($query) { $query->where('is_active', 1); }])->with('writer')->first();
//                if ($pro->product != null){
//                    $products[] = $pro;
//                }
            }
//            return $products;
            $writers = Writer::all();
            $publishers = Publisher::all();
            return Inertia::render('Frontend/Products', compact('products', 'writers', 'publishers', 'subCats'));

        }
        else if ($tur == 'journal') {

            $publishers = Publisher::all();
            foreach ($data as $value) {
//                $pro = Journal::where('product_id', $value->id)->with(['product' => function($query) { $query->where('is_active', 1); }])->first();
                $products[] = Journal::where('product_id', $value->id)
                    ->with('product')
                    ->with('publisher' , function($query) { $query->withTrashed(); })
                    ->first();
//                if ($pro->product != null){
//                    $products[] = $pro;
//                }
            }

            return Inertia::render('Frontend/Products', compact('products', 'publishers', 'subCats'));

        } else {
            return Inertia::render('Frontend/NotPage/NotPage');
        }
    }


    private function formatTree($subCats, $allCategories, $prods)
    {
        foreach ($subCats as $subCat) {
            $subCat->children = $allCategories->where('parent_id', $subCat->id)->values();
            $subCat->products = $prods->where('category_id', $subCat->id)->values();
            if (count($subCat->products) > 0) {
                $this->as[] = $subCat->id;
            }
            if (count($subCat->children) > 0) {
                self::formatTree($subCat->children, $allCategories, $prods);
            }
        }
    }


}
