<?php

namespace App\Http\Requests\News;

class IndexRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'search' => 'array',
            'search.*' => 'string',
            'page_size' => 'integer',
            'page' => 'integer',
        ];
    }
}
