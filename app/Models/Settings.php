<?php

namespace App\Models;

use App\Models\Abstract\AbstractModel;

class Settings extends AbstractModel
{
    protected $hidden = [
        'user_id',
        'id',
    ];
    const LANG_RU = 'ru';


    public static function getLangs()
    {
        return [
            self::LANG_RU,
        ];
    }
}
