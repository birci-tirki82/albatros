<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
//use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic as Image;

//use Intervention\Image\Image;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {


        $publishers = Publisher::all();
        return Inertia::render('Backend/Publisher/Index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $publishers = Publisher::all();
        return Inertia::render('Backend/Publisher/Create', compact('publishers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PublisherRequest $request)
    {
//        return storage_path("app/public/images/publishers/small/");
        if ($request->file('image')) {
            $file = $request->file('image');
            $hashName = $file->hashName();

            //Burada aynı dosyayı public içerisinede kaydetmesi gerekiyor. Terminalden php artisan storage:link komutuyla storage dosyasının kopyasını public
            //içerisine kopyalayabiliyoruz. Fakat bu canlıya geçince çalışırmı bakmak lazım..

            Publisher::create([
                'name' => toWord($request->name),
                'image' => $hashName,
//                'is_active' => $request->get('is_active'),
            ]);
            $file->storeAs("public/images/publishers/", $hashName);
        }



        return redirect()->route('publisher.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $publisher = Publisher::find($id);
        return Inertia::render('Backend/Publisher/Update', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
//        return $request;
        $hashName = $request->old_image;
        if ($request->file('image')) {

            //Update işleminde resim değişikliği yapılırsa önce klasördeki resmi siliyoruz.. Alttaki iki satır
            $filePath = "public/images/publishers/" . $hashName;
            Storage::disk("local")->delete($filePath);

            $file = $request->file('image');
            $hashName = $file->hashName();
            $file->storeAs("public/images/publishers/", $hashName);
        }
        $publisher = Publisher::find($id);
        $publisher->name = toWord($request->name);
        $publisher->image = $hashName;
//        $publisher->is_active = $request->get('is_active');
        $publisher->save();
        return redirect()->route('publisher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $publisher = Publisher::find($id);
//        $books = Book::all();

//        $num = 0;
//        foreach ($books as $book) {
//            if ($publisher->id === $book->publisher_id)
//                $num++;
//        }
//        if ($num > 0)
//            return "Bu yayın evine ait kitap bulunmakta. Silemezsin!!!";
//        else {
            $publisher->delete();
//            $filepath = "public/images/publishers/" . $publisher->image;
//            if (Storage::disk("local")->exists($filepath)) {
//                Storage::disk("local")->delete($filepath);
//            }
//        }
        return redirect()->route('publisher.index');
    }
}
