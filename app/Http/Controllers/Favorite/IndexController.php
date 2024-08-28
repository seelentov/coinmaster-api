<?php

namespace App\Http\Controllers\Favorite;


class IndexController extends BaseController
{
    public function __invoke()
    {
        $userId = auth()->user()->id;

        $data = $this->favorites->getCollection("user_id", $userId, false);

        return $data;
    }
}
