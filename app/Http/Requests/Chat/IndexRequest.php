<?php

namespace App\Http\Requests\Chat;

class IndexRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'page_size' => 'integer',
        ];
    }
}
