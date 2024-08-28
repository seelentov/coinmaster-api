<?php

namespace App\Repositories\Base\Traits;

trait HasRemove
{
    public function remove($key, $value)
    {
        $entities = $this->model::where($key, $value);

        $entities->delete();
    }
}
