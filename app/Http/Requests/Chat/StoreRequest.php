<?php

namespace App\Http\Requests\Chat;

use App\Models\FavoriteOption;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'text' => 'required|string'
        ];
    }
}
