<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Publisher;
use App\Models\Writer;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\FavoriteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Intervention\Image\ImageManagerStatic as Image;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */

    private $repository;
    private $favoriteRepository;
    public function __construct(CartRepositoryInterface $repository, FavoriteRepository $favoriteRepository)
    {
        $this->repository = $repository;
        $this->favoriteRepository = $favoriteRepository;
    }

    public function index()
    {

        $books = Book::with('product', 'product.category')
            ->with('writer' , function($query) { $query->withTrashed(); })
            ->with('publisher' , function($query) { $query->withTrashed(); })
            ->get();
//       $products = Product::with('category')->get();
        return Inertia::render('Backend/Book/Index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
//        $books = Book::all();
        $writers = Writer::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        return Inertia::render('Backend/Book/Create', compact( 'writers', 'publishers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookRequest $request)
    {
//        dd($request);
//        return $request;

//        $hashName = '';
        if ($request->file('image')) {
            $file = $request->file('image');
            $hashName = $file->hashName();



            $data = Product::create([
                "category_id" => $request->category_id['id'],
                "tur" => 'book',
                'name' => toWord($request->name),
                'slug' => $request->slug ? Str::of($request->slug)->slug() : Str::of($request->name)->slug(),
                'description' => $request->description,
                'price' => $request->price,
                'old_price' => $request->old_price,
                'stok' => $request->stok,
                'image' => $hashName,
            ]);

//            return $data->id;
//            $product_id = Product::all();

            Book::create([
                'writer_id' => $request->writer_id['id'],
                'product_id' => $data->id,
                'publisher_id' => $request->publisher_id['id'],
                'publish_date' => $request->publish_date,
                'isbn' => $request->isbn,
                'language' => $request->language,
                'pages' => $request->pages,
                'type' => $request->type,
                'paper_type' => $request->paper_type,
                'dimensions' => $request->dimensions,
                'feature' => $request->feature,
                'is_active' => $request->get('is_active'),

            ]);

            ProductImage::create([
                'product_id' => $data->id,
                'small' => 'small_'.$hashName,
                'medium' => 'medium_'.$hashName,
                'large' => 'large_'.$hashName,
            ]);

            $path = storage_path("app/public/images/products/");
            image_resize($file, $path, $hashName);

            $image = Image::make($file->getRealPath());
            $image->resize(358, 358);
            $image->save($path.$hashName);
//            $file->storeAs("public/images/products/", $hashName);
        }


        return redirect()->route('book.index')->with('message', 'Kitap Eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $book = Book::with('product', 'product.category')->find($id);
//        $books = Book::with('writer')->with('publisher')->with('product', 'product.category')->get();
        $writers = Writer::all();
        $publishers = Publisher::all();
        $categories = Category::where('tur', 'book')->get();
        return Inertia::render('Backend/Book/Update', compact('book', 'writers', 'publishers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BookRequest $request, $id)
    {
//        $wada = $request->is_active;
//        dd($wada);
//        $product = Product::find($id);
//        $book = Book::where('product_id', $product->id)->first();
//        return $product_images = ProductImage::where('product_id', $product->id)->where('small' , 'small_'.$request->old_image)->first();
//        return $id;
//        if (booleanValue($request->is_active) == true){
//            return "merhaba";
//        }

       $hashName = $request->old_image;
        if ($request->file('image')) {
            //Update işleminde resim değişikliği yapılırsa önce klasördeki resmi siliyoruz.. Alttaki iki satır
            $filePath = "public/images/products/";

            Storage::disk("local")->delete([$filePath.$hashName, $filePath.'small_'.$hashName, $filePath.'medium_'.$hashName, $filePath.'large_'.$hashName]);
            $file = $request->file('image');
            $hashName = $file->hashName();

            $path = storage_path("app/public/images/products/");
            image_resize($file, $path, $hashName);

            $image = Image::make($file->getRealPath());
            $image->resize(358, 358);
            $image->save($path.$hashName);

//            $file->storeAs("public/images/products/", $hashName);
        }
        $product = Product::find($id);
        $book = Book::where('product_id', $product->id)->first();
        $product_images = ProductImage::where('product_id', $product->id)->where('small' , 'small_'.$request->old_image)->first();

//        return $product;

        $product->category_id = $request->category_id['id'];
//        $product->tur = $request->tur['id'];
        $product->name = toWord($request->name);
        $product->slug = $request->slug ? Str::of($request->slug)->slug() : Str::of($request->name)->slug();
        $product->description = $request->description;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->stok = $request->stok;
        $product->image = $hashName;
        $product->is_active = $request->get('is_active');


        $book->writer_id = $request->writer_id['id'];
        $book->publisher_id = $request->publisher_id['id'];
        $book->publish_date = $request->publish_date;
        $book->isbn = $request->isbn;
        $book->language = $request->language;
        $book->pages = $request->pages;
        $book->type = $request->type;
        $book->paper_type = $request->paper_type;
        $book->dimensions = $request->dimensions;
        $book->feature = $request->feature;


        $product_images->small = 'small_'.$hashName;
        $product_images->medium = 'medium_'.$hashName;
        $product_images->large = 'large_'.$hashName;


        if ( $request->get('is_active') == 0){
            $cart = Cart::where('product_id', $product->id)->get();
            $favorite = Favorite::where('product_id', $product->id)->get();
            foreach ($cart as $item){
                $this->repository->remove($item->id);
            }
            foreach ($favorite as $value){
                $this->favoriteRepository->remove($value->id);
            }
        }

        $product->save();
        $book->save();
        $product_images->save();
//        return $product->get('is_active');
//        return "keke";


        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
//        return $id;
        $book = Book::find($id);
        $product = Product::find($book->product_id);


        $cart = Cart::where('product_id', $product->id)->get();
        $favorite = Favorite::where('product_id', $product->id)->get();
        if ($cart){
            foreach ($cart as $item){
                $this->repository->remove($item->id);
            }
        }
        if ($favorite){
            foreach ($favorite as $value){
                $this->favoriteRepository->remove($value->id);
            }
        }


//        $product_images = ProductImage::where('product_id',$book->product_id)->get();


//        $filepath = "public/images/products/";
//        if (Storage::disk("local")->exists($filepath)){
//            Storage::disk("local")->delete($filepath.$product->image);
//            foreach ($product_images as $image){
//                Storage::disk("local")->delete($filepath.$image->small);
//                Storage::disk("local")->delete($filepath.$image->medium);
//                Storage::disk("local")->delete($filepath.$image->large);
//                $image->delete();
//            }
//        }

        $book->delete();
        $product->delete();

        return redirect()->route('book.index');
    }
}
