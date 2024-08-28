<?php

namespace App\Repositories\Base\Traits;

trait HasGetCollection
{
    public function getCollection($arg1, $arg2 = null, $paginated = true)
    {
        $perPage = isset($arg1['perPage']) ? $arg1['perPage'] : $this->perPage;

        if (is_array($arg1)) {
            $res = $this->model::filter($arg1);
        } else {
            $key = $arg1;
            $value = $arg2;
            $res = $this->model::where($key, $value);
        }

        if (isset($this->with)) {
            $res = $res->with($this->with);
        }

        if (method_exists($this, 'sort')) {
            $res = $this->sort($res);
        }

        if ($paginated) {
            return $res->paginate($perPage);
        }

        return $res->get();
    }
}
