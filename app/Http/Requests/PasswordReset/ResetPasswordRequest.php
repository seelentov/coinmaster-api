<?php

namespace App\Http\Requests\PasswordReset;

use Illuminate\Contracts\Validation\Validator;


class ResetPasswordRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'string|required',
            'password_confirmation' => 'string|required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return "asd";
    }
}
