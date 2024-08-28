<?php

namespace App\Http\Controllers\Chat;

use App\Http\Requests\Chat\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke($chatId, StoreRequest $request)
    {
        $body = $request->validated();
        $body["user_id"] = auth()->user()->id;
        $body["chat_id"] = $chatId;

        $this->messages->create($body);
    }
}
