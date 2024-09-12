<?php

namespace App\Http\Requests\Settings;

use App\Models\Settings;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            "notif_time" => 'date_format:H:i:s',
            "notif_active" => "boolean",
            "lang" => 'in:' . implode(',', Settings::getLangs()),
        ];
    }
}
