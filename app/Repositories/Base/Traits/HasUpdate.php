<?php

namespace App\Repositories\Base\Traits;

trait HasUpdate
{
    public function update($key, $value, $data)
    {
        $entity = $this->model::where($key, $value)->update($data);
        return $entity;
    }
}
