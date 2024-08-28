<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Requests\Favorite\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $body = $request->validated();
        $body["user_id"] = auth()->user()->id;

        $this->favorites->create($body);
    }
}
