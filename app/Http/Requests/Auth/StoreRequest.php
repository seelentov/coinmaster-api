<?php

namespace App\Http\Requests\Auth;


class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'email' => 'string|required',
            'phone' => 'string|required',
            'password' => 'string|required',
        ];
    }
}
