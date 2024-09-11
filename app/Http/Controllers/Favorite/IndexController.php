<?php

namespace App\Http\Controllers\Favorite;


class IndexController extends BaseController
{
    public function __invoke()
    {
        $userId = auth()->user()->id;


        $data = $this->favorites->getCollection("user_id", $userId, false);

        $codes = array_map(fn($fav) => $fav['identifier'], $data->toArray());

        $infos = $this->valuteService->getValuteInfoMany($codes);

        foreach ($data as &$fav) {
            $fav['valute'] = $infos[$fav['identifier']];
        }

        return $data;
    }
}
