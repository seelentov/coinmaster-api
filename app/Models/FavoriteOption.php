<?php

namespace App\Models;

use App\Models\Abstract\AbstractModel;

class FavoriteOption extends AbstractModel
{
    const TIME_TYPE_DAY = 'day';
    const TIME_TYPE_MONTH = 'month';
    const TIME_TYPE_YEAR = 'year';

    const VALUE_TYPE_PERCENT = 'percent';
    const VALUE_TYPE_VALUE = 'value';

    const OPTION_TYPE_FALL = 'fall';
    const OPTION_TYPE_RAISE = 'raise';
    const OPTION_TYPE_ALL = 'all';

    public static function getTimeTypes()
    {
        return [
            self::TIME_TYPE_DAY,
            self::TIME_TYPE_MONTH,
            self::TIME_TYPE_YEAR,
        ];
    }

    public static function getValueTypes()
    {
        return [
            self::VALUE_TYPE_PERCENT,
            self::VALUE_TYPE_VALUE,
        ];
    }

    public static function getOptionTypes()
    {
        return [
            self::OPTION_TYPE_FALL,
            self::OPTION_TYPE_RAISE,
            self::OPTION_TYPE_ALL,
        ];
    }

    public function favorite()
    {
        return $this->belongsTo(Favorite::class);
    }
}
