<?php

namespace App\Http\Controllers\Valute;

use App\Http\Requests\Valute\IndexRequest;
use App\Http\Resources\Valute\ValuteResource;

class IndexController extends BaseController
{
    public function __invoke(IndexRequest $request)
    {
        $query = $request->validated();
        dd($query);
        $data = $this->valuteService->getDaily($query);

        return ValuteResource::collection($data);
    }
}
