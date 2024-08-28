<?php

namespace App\Http\Requests\Auth;


class VerifyRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'phone' => 'required|string',
            'code' => 'required|integer',
        ];
    }
}
