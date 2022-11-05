<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\JournalRequest;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Journal;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Publisher;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\FavoriteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Intervention\Image\ImageManagerStatic as Image;

class JournalController extends Controller
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
        $journals = Journal::with('product', 'product.category')
            ->with('publisher' , function($query) { $query->withTrashed(); })
            ->get();
//        $books = Book::with('writer')->with('publisher')->with('product', 'product.category')->get();
//        dd($journals);
//        return $journals;
        return Inertia::render('Backend/Journal/Index', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $publishers = Publisher::all();
        $categories = Category::all();
        return Inertia::render('Backend/Journal/Create', compact(  'publishers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(JournalRequest $request)
    {
//        return $request;
        if ($request->file('image')) {
            $file = $request->file('image');
            $hashName = $file->hashName();

            $data = Product::create([
                "category_id" => $request->category_id['id'],
                "tur" => 'journal',
                'name' => toWord($request->name),
                'slug' => $request->slug ? Str::of($request->slug)->slug() : Str::of($request->name)->slug(),
                'description' => $request->description,
                'price' => $request->price,
                'old_price' => $request->old_price,
                'stok' => $request->stok,
                'image' => $hashName,
            ]);

            Journal::create([
                'publisher_id' => $request->publisher_id['id'],
                'product_id' => $data->id,
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

            //Create işleminde hata aldığımızda dergi eklenmese bile resim kaydediliyor. O yüzden bu satırı aşşağıya aldım.
            $path = storage_path("app/public/images/products/");
            image_resize($file, $path, $hashName);

            $image = Image::make($file->getRealPath());
            $image->resize(358, 358);
            $image->save($path.$hashName);
//            $file->storeAs("public/images/products/", $hashName);
        }


        return redirect()->route('journal.index');
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
        $journal = Journal::with('product', 'product.category')->find($id);
        $publishers = Publisher::all();
        $categories = Category::where('tur', 'journal')->get();
        return Inertia::render('Backend/Journal/Update', compact('journal',  'publishers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(JournalRequest $request, $id)
    {
//        return $request;
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
//        $journal = Journal::find($product->product_id);
        $journal = Journal::where('product_id', $product->id)->first();
        $product_images = ProductImage::where('product_id', $product->id)->where('small' , 'small_'.$request->old_image)->first();


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

        $journal->publisher_id = $request->publisher_id['id'];
        $journal->publish_date = $request->publish_date;
        $journal->isbn = $request->isbn;
        $journal->language = $request->language;
        $journal->pages = $request->pages;
        $journal->type = $request->type;
        $journal->paper_type = $request->paper_type;
        $journal->dimensions = $request->dimensions;
        $journal->feature = $request->feature;


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
        $journal->save();
        $product_images->save();

        return redirect()->route('journal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $journal = Journal::find($id);
        $product = Product::find($journal->product_id);

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

//        $product_images = ProductImage::where('product_id',$journal->product_id)->get();
//
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

        $journal->delete();
        $product->delete();

        return redirect()->route('journal.index');
    }
}
