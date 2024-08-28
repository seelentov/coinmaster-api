<?php

namespace App\Repositories\Base\Traits;


trait HasGetOrCreate
{
    public function getOrCreate($finder, $data)
    {
        $entity = $this->model::firstOrCreate($finder, $data);
        return $entity;
    }
}
