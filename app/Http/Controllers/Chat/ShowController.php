<?php

namespace App\Http\Controllers\Chat;

use App\Http\Requests\Chat\IndexRequest;

class ShowController extends BaseController
{
    public function __invoke($identifier, IndexRequest $request)
    {
        $query = $request->validated();
        $query = ["identifier" => $identifier];

        $data = $this->chats->getOrCreate($identifier, $query);
        return $data;
    }
}
