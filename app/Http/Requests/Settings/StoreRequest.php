<?php

namespace App\Http\Requests\Settings;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            "notif_time" => "time",
            "notif_active" => "boolean",
        ];
    }
}
