<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Repositories\Chat\ChatRepository;
use App\Repositories\Message\MessageRepository;

class BaseController extends Controller
{
    public function __construct(
        protected readonly MessageRepository $messages,
        protected readonly ChatRepository $chats
    ) {}
}
