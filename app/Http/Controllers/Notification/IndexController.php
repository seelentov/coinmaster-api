<?php

namespace App\Http\Controllers\Notification;

use App\Http\Requests\News\IndexRequest;
use App\Http\Resources\News\NewsResource;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $userId = auth()->user()->id;
        $data = $this->notifications->getCollection("user_id", $userId, false);
        return $data;
    }
}
