<?php

namespace App\Http\Requests\PasswordReset;

class SendResetLinkRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users',
        ];
    }
}
