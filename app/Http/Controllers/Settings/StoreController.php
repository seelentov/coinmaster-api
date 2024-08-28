<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Settings\StoreRequest;
use App\Http\Requests\News\IndexRequest;
use App\Http\Resources\News\NewsResource;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $body = $request->validated();

        $this->settings->update('user_id', auth()->user()->id, $body);
    }
}
