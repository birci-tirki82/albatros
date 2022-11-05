<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WriterRequest extends FormRequest
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
            'lastname' => 'required|max:250|min:2|string',
            'info' => 'required',
//            'image' => 'required|mimes:jpg,jpeg,png',
            'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'İsim alanı gereklidir..',
            'name.max' => 'İsim alanı en fazla 250 karakter alabilir..',
            'name.min' => 'İsim alanı en az 2 karakter alabilir..',
            'name.string' => 'İsim alanı string olmalıdır..',

            'lastname.required' => 'Soyisim alanı gereklidir..',
            'lastname.max' => 'Soyisim alanı en fazla 250 karakter alabilir..',
            'lastname.min' => 'Soyisim alanı en az 2 karakter alabilir..',
            'lastname.string' => 'Soyisim alanı string olmalıdır..',

            'info.required' => 'Açıklama alanı gereklidir..',

            'image.required' => 'Resim eklemek gereklidir..',
//            'image.mimes' => 'Sadece jpg,jpeg,png uzantılı dosyalar kullanılabilir..',

        ];

    }
}
