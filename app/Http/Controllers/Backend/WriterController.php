<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\WriterRequest;
use App\Models\Book;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $writers = Writer::all();
        return Inertia::render('Backend/Writer/Index', compact('writers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $writers = Writer::all();
        return Inertia::render('Backend/Writer/Create', compact('writers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WriterRequest $request)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            $hashName = $file->hashName();

            //Burada aynı dosyayı public içerisinede kaydetmesi gerekiyor. Terminalden php artisan storage:link komutuyla storage dosyasının kopyasını public
            //içerisine kopyalayabiliyoruz. Fakat bu canlıya geçince çalışırmı bakmak lazım..
            Writer::create([
                'name' => toWord($request->name),
                'lastname' => toWord($request->lastname),
                'info' => $request->info,
                'image' => $hashName,
//                'is_active' => $request->get('is_active'),
            ]);
            $file->storeAs("public/images/writers/", $hashName);
        }


        return redirect()->route('writer.index');
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
        $writer = Writer::find($id);
        return Inertia::render('Backend/Writer/Update', compact('writer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WriterRequest $request, $id)
    {
//        return $request;
        $hashName = $request->old_image;
        if ($request->file('image')) {

            //Update işleminde resim değişikliği yapılırsa önce klasördeki resmi siliyoruz.. Alttaki iki satır
            $filePath = "public/images/writers/". $hashName;
            Storage::disk("local")->delete($filePath);

            $file = $request->file('image');
            $hashName = $file->hashName();
            $file->storeAs("public/images/writers/", $hashName);
        }
        $writer = Writer::find($id);
        $writer->name = toWord($request->name);
        $writer->lastname = toWord($request->lastname);
        $writer->info = $request->info;
        $writer->image = $hashName;
//        $writer->is_active = $request->get('is_active');
        $writer->save();
        return redirect()->route('writer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $writer = Writer::find($id);
//        $books = Book::all();

//        $num = 0;
//        foreach ($books as $book){
//            if ($writer->id === $book->writer_id)
//                $num++;
//        }
//        if ($num > 0)
//            return "Bu yazara ait kitap bulunmakta. Silemezsin!!!";
//        else {
            $writer->delete();
//            $filepath = "public/images/writers/" . $writer->image;
//            if (Storage::disk("local")->exists($filepath)){
//                Storage::disk("local")->delete($filepath);
//            }
//        }
        return redirect()->route('writer.index');
    }
}
