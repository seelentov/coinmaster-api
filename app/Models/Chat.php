<?php

namespace App\Models;

use App\Models\Abstract\AbstractModel;

class Chat extends AbstractModel
{
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
