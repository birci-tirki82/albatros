<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            "name" => "required",
            "surname" => "required",
            "country" => "required",
            "city" => "required",
//            "slug" => "max:250|min:2|nullable|unique:books",
            "district" => "required",
            "zipcode" => "required",
            "phone" => "required",
            "address" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "İsim alanı gereklidir..",
            "surname.required" => "Soyisim alanı gereklidir..",
            "country.required" => "Ülke alanı gereklidir..",
            "city.required" => "İl alanı gereklidir..",
            "district.required" => "İlçe alanı gereklidir..",
            "zipcode.required" => "Zipkod alanı gereklidir..",
            "phone.required" => "Telefon alanı gereklidir..",
            "address.required" => "Adres alanı gereklidir..",

        ];

    }
}
