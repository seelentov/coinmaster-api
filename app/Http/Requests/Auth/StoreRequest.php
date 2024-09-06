<?php

namespace App\Http\Requests\Auth;


class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|required|unique:users,name',
            'email' => 'string|required|unique:users,email',
            'phone' => 'string|required|unique:users,phone',
            'password' => 'string|required',
        ];
    }
}
