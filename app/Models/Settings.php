<?php

namespace App\Models;

use App\Models\Abstract\AbstractModel;

class Settings extends AbstractModel
{
    protected function casts(): array
    {
        return [
            'notif_time' => 'time',
        ];
    }
}
