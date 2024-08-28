<?php

namespace App\Http\Controllers\QueryHelper;

use App\Http\Requests\QueryHelper\IndexRequest;

class IndexController extends BaseController
{
    public function __invoke(IndexRequest $request)
    {
        $query = $request->validated();

        $data = $this->queryHelper->getHelp($query);
        return $data;
    }
}
