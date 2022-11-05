<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
//        $user_id = $this->request->get('user_id');
        return [
            "name" => "required|max:90|min:2|string",
            "surname" => "required|max:90|min:2|string",
            "email" => "required|max:155|string|min:7|unique:users",
//            "password" => "required|max:50|min:6|confirmed",
            "password" => "required|min:6|confirmed",
            "password_confirmation" => "required|min:6",
            "is_active" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "İsim alanı gereklidir..",
            "name.max" => "İsim alanı en fazla 90 karakter alabilir..",
            "name.min" => "İsim alanı en az 2 karakter alabilir..",
            "name.string" => "İsim alanı string olmalıdır..",

            "surname.required" => "İsim alanı gereklidir..",
            "surname.max" => "İsim alanı en fazla 90 karakter alabilir..",
            "surname.min" => "İsim alanı en az 2 karakter alabilir..",
            "surname.string" => "İsim alanı string olmalıdır..",

            "email.required" => "Email alanı gereklidir..",
            "email.max" => "Email alanı en fazla 155 karakter alabilir..",
            "email.min" => "Email alanı en az 7 karakter alabilir..",
            "email.string" => "Email alanı string olmalıdır..",
            "email.unique" => "Email zaten alınmış..",

            "password.required" => "Password alanı gereklidir..",
            "password.max" => "Password alanı en fazla 50 karakter alabilir..",
            "password.min" => "Password alanı en az 6 karakter alabilir..",
            "password.confirmed" => "Şifreler eşleşmiyor..",
            "password_confirmation.required" => "Şifre tekrarı boş bırakılamaz..",

            "is_active.required" => "Aktif Pasif alanı gereklidir..",
        ];

    }
}
