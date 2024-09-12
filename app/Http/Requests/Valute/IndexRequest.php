<?php

namespace App\Http\Requests\Valute;

class IndexRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'array',
            'name.*' => 'string',
            'code' => 'array',
            'code.*' => 'string',
            'orderBy' => 'string',
            'orderDir' => 'string',
            'date' => 'string'
        ];
    }
}
