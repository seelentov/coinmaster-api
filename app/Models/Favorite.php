<?php

namespace App\Models;

use App\Models\Abstract\AbstractModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends AbstractModel
{
    public function favorite_options()
    {
        return $this->hasMany(FavoriteOption::class);
    }
}
