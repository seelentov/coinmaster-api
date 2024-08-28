<?php

namespace App\Http\Requests\Valute;

class ShowRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'start_date' => 'string',
            'end_date' => 'string',
        ];
    }
}
