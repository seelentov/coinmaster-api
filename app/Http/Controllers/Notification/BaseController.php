<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Repositories\Notification\NotificationRepository;

class BaseController extends Controller
{
    public function __construct(
        protected readonly NotificationRepository $notifications
    ) {}
}
