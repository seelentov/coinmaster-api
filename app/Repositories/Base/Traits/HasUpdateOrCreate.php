<?php

namespace App\Repositories\Base\Traits;

trait HasUpdateOrCreate
{
    public function updateOrCreate($finder, $data)
    {
        $entity = $this->model::with("favorite")->where("favorite.user_id", 1)->get();

        dd($entity);

        $entity->updateOrCreate($finder, $data);
        return $entity;
    }
}
