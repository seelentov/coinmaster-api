<?php

namespace App\Http\Requests\FavoriteOption;

use App\Models\FavoriteOption;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'time_type' => 'in:' . implode(',', FavoriteOption::getTimeTypes()),
            'time_count' => 'integer|min:1',
            'value_count' => 'integer|min:0',
            'value_type' => 'in:' . implode(',', FavoriteOption::getValueTypes()),
            'option_type' => 'in:' . implode(',', FavoriteOption::getOptionTypes()),
        ];
    }
}
