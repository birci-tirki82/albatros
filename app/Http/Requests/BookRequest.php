<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
//        dd($this->request->get('id')) ;
        $product_id = $this->request->get('product_id');
//        dd($product_id) ;
        return [
            "writer_id" => "required",
            "publisher_id" => "required",
            "category_id" => "required",
            "name" => "required|min:2|unique:App\Models\Product,name,$product_id",
//            "slug" => "unique:App\Models\Book,email,$book_id",
            "description" => "required",
            "publish_date" => "required",
            "isbn" => "required",
            "language" => "required",
            "pages" => "required|numeric",
            "type" => "required",
            "paper_type" => "required",
            "dimensions" => "required",
            "feature" => "required",
            "price" => "numeric|nullable|between:0," . request('old_price'),
            'old_price' => 'required|numeric|min:0',
            "stok" => "required|numeric",
//            "image" => "required|mimes:jpg,jpeg,png",
            "image" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "İsim alanı gereklidir..",
            "name.min" => "İsim alanı en az 2 karakter alabilir..",
            "name.unique" => "Kitap ismi daha önce alınmış..",

//            "slug.min" => "Slug en az 2 karakter olabilir..",
//            "slug.max" => "Slug en fazla 250 karakter olabilir..",
//            "slug.unique" => "Kitap ismi daha önce alınmış..",

            "price.numeric" => "İndirimli Fiyat sayısal olmalıdır..",
            "price.between" => "İndirimli fiyat en fazla fiyat değeri kadar girilebilir..",

            "writer_id.required" => "Yazar alanı gereklidir..",
            "publisher_id.required" => "Yayın evi alanı gereklidir..",
            "category_id.required" => "Kategori alanı gereklidir..",
            "description.required" => "Açıklama alanı gereklidir..",
            "publish_date.required" => "Yayım tarihi alanı gereklidir..",
            "isbn.required" => "ISBN alanı gereklidir..",
            "language.required" => "Dil alanı gereklidir..",

            "pages.required" => "Sayfa sayısı alanı gereklidir..",
            "pages.numeric" => "Sayfa sayısı alanı sayısal olmalıdır..",

            "type.required" => "Tip alanı gereklidir..",
            "paper_type.required" => "Sayfa tipi alanı gereklidir..",
            "dimensions.required" => "Boyutlar alanı gereklidir..",
            "feature.required" => "Özellik alanı gereklidir..",

            "old_price.required" => "Fiyat alanı gereklidir..",
            "old_price.numeric" => "Fiyat alanı sayısal olmalıdır..",
            'old_price.min' => 'Fiyat 0 dan düşük olamaz..',

            "stok.required" => "Stok alanı gereklidir..",
            "stok.numeric" => "Stok alanı sayısal olmalıdır..",

            "image.required" => "Resim alanı gereklidir..",
//            "image.mimes" => "Sadece jpg,jpeg,png uzantılı dosyalar kullanılabilir..",
        ];

    }
}
