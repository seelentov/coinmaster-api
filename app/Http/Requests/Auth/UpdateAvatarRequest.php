<?php

namespace App\Http\Requests\Auth;


class UpdateAvatarRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
