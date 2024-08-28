<?php

namespace App\Http\Requests\Favorite;

use App\Models\FavoriteOption;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'identifier' => 'required|string',
        ];
    }
}
