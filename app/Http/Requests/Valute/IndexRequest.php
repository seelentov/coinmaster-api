<?php

namespace App\Http\Requests\Valute;

class IndexRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'orderBy' => 'string',
            'orderDir' => 'string',
            'date' => 'string'
        ];
    }
}
