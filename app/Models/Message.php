<?php

namespace App\Models;

use App\Models\Abstract\AbstractModel;

class Message extends AbstractModel
{
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
