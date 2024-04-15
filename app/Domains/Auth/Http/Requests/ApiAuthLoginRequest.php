<?php

namespace App\Domains\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiAuthLoginRequest extends FormRequest
{

    public function authorize()
    {

        return true;
    }


    public function rules()
    {

        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
