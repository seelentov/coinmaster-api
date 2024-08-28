<?php

namespace App\Repositories\Base\Traits;


trait HasCreate
{
    public function create($data)
    {
        $entity = $this->model::create($data);
        return $entity;
    }
}
