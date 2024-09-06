<?php

namespace App\Http\Controllers\News;

use App\Http\Requests\News\IndexRequest;
use App\Http\Resources\News\NewsResource;

class IndexController extends BaseController
{
    public function __invoke(IndexRequest $request)
    {
        $query = $request->validated();
        dd($query);
        $data = $this->news->getNewsList($query);
        return NewsResource::collection($data);
    }
}
