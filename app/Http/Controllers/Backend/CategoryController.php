<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $categories = Category::all();
        return Inertia::render('Backend/Category/Index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $categories = Category::all();
        $books = Category::where('tur', 'book')->get();
        $journals = Category::where('tur', 'journal')->get();
        return Inertia::render('Backend/Category/Create', compact('categories', 'books', 'journals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            'parent_id' => $request->parent_id['id'],
            'name' => toWord($request->name),
            'tur' => $request->tur,
            'slug' => slugify($request->name),
            'is_active' => $request->get('is_active'),
        ]);

        return redirect()->route('category.index');
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
        $category = Category::find($id);
        $categories = Category::all();
        return Inertia::render('Backend/Category/Update', compact('category', 'categories'));
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
        $category = Category::find($id);
        $category->name = toWord($request->name);
        $category->slug = $request->slug ? Str::of($request->slug)->slug() : Str::of($request->name)->slug();
        $category->parent_id = $request->parent_id['id'];
        $category->is_active = $request->get('is_active');
        $category->save();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $categories = Category::all();

        $num = 0;
        foreach ($categories as $value) {
            if ($category->id === $value->parent_id)
                $num++;
        }
        if ($num > 0)
            return "Bu kategori alt kategori barındırıyor. Silinemez!!";
        else {
            $books = Book::all();
            $num2 = 0;
            foreach ($books as $book) {
                if ($category->id === $book->category_id)
                    $num2++;
            }
            if ($num2 > 0)
                return "Bu kategoriye ait kitap bulunuyor.. Silemezsin!!";
            else
            $category->delete();
        }

        return redirect()->route('category.index');
    }
}
