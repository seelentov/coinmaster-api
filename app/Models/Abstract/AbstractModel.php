<?php

namespace App\Models\Abstract;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class AbstractModel extends Model
{
    use HasFactory;
    use Filterable;

    public $timestamps = false;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
