<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        return [
            'name' => 'required|max:250|min:2|string',
//            'slug' => 'min:2|nullable|sometimes|unique:categories',
            'parent_id' => 'required',
            'is_active' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'İsim alanı gereklidir..',
            'name.max' => 'İsim alanı en fazla 250 karakter alabilir..',
            'name.min' => 'İsim alanı en az 2 karakter alabilir..',
            'name.string' => 'İsim alanı string olmalıdır..',

//            'slug.min' => 'Slug alanı en az 2 karakter alabilir..',
//            'slug.unique' => 'Slug daha önce alınmış..',

            'parent_id.required' => 'Üst Kategori alanı zorunludur..',

            'is_active.required' => 'Aktif Pasif alanı zorunludur..',
        ];

    }
}
