<?php

namespace App\Repositories\Base\Traits;

trait HasGet
{
    public function get($key, $value)
    {
        $res = $this->model::where($key, $value);

        if (isset($this->with)) {
            $res = $res->with($this->with);
        }

        return $res->first();
    }
}
