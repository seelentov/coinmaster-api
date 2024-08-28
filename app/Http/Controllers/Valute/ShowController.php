<?php

namespace App\Http\Controllers\Valute;

use App\Http\Requests\Valute\ShowRequest;
use App\Http\Resources\Valute\ValuteResource;

class ShowController extends BaseController
{
    public function __invoke(string $code, ShowRequest $request)
    {
        $query = $request->validated();


        $data = $this->valuteService->getValute($code, $query["start_date"], $query["end_date"]);
        return new ValuteResource($data);
    }
}
