<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignUpFormRequest extends FormRequest
{

    public function authorize():bool
    {
        return auth()->check();
    }


    public function rules():array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }
}
