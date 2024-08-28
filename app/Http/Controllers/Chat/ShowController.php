<?php

namespace App\Http\Controllers\Chat;


class ShowController extends BaseController
{
    public function __invoke($identifier)
    {
        $data = ["identifier" => $identifier];
        $data = $this->chats->getOrCreate($data, $data);
        return $data;
    }
}
