<?php

namespace App\Repositories\Base\Traits;

use Illuminate\Support\Facades\DB;

trait HasCreateMany
{

    public function createMany($datas)
    {
        $result = [];

        DB::transaction(function () use ($datas) {
            foreach ($datas as $data) {
                $entity = $this->model::create($data);
                $result[] = $entity;
            }
        });
        return $result;
    }
}
