<?php

namespace App\Http\Controllers\Notification;

use App\Http\Requests\News\IndexRequest;
use App\Http\Resources\News\NewsResource;

class CheckController extends BaseController
{
    public function __invoke()
    {
        $userId = auth()->user()->id;
        $this->notifications->checkUpdates($userId);
    }
}
