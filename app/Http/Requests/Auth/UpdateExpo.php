<?php

namespace App\Http\Requests\Auth;


class UpdateExpo extends BaseRequest
{
    public function rules(): array
    {
        return [
            'expo_token' => 'string|required',
        ];
    }
}
