<?php

namespace App\Http\Requests\QueryHelper;

class IndexRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'search' => 'string',
        ];
    }
}
