<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublisherRequest extends FormRequest
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
            'image' => 'required',
//            'image' => 'required|image|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'İsim alanı gereklidir..',
            'name.max' => 'İsim alanı en fazla 250 karakter alabilir..',
            'name.min' => 'İsim alanı en az 2 karakter alabilir..',
            'name.string' => 'İsim alanı string olmalıdır..',

            'image.required' => 'Resim eklemek gereklidir..',
//            'image.mimes' => 'Sadece jpg,jpeg,png uzantılı dosyalar kullanılabilir..',
        ];

    }
}
