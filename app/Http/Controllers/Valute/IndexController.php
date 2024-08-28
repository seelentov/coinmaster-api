<?php

namespace App\Http\Controllers\Valute;

use App\Http\Resources\Valute\ValuteResource;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $data = $this->valuteService->getDaily();
        return ValuteResource::collection($data);
    }
}
