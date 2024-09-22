<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserNotification;
use App\Notifications\Facades\ExpoChannel;
use App\Notifications\ExpoNotification;

class TestController extends Controller
{
    public function __invoke()
    {
        $user = User::find(1);

        ExpoChannel::send($user, new ExpoNotification('Заголовок', 'Текст', ['some_data' => 'data']));

        $notifications = UserNotification::get();

        return $notifications;
    }
}
