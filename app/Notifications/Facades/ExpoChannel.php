<?php

namespace App\Notifications\Facades;

use App\Components\Clients\ExpoClient;
use App\Models\User;
use App\Models\UserNotification;
use App\Notifications\ExpoNotification;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;

class ExpoChannel extends Facade
{
    protected static $client;

    public static function send(User $notifiable, ExpoNotification $notification)
    {
        self::$client = new ExpoClient();

        $expoToken = $notifiable->expo_token;

        $message = [
            'to' => $expoToken,
            'title' => $notification->getData($notifiable)['header'],
            'body' => $notification->getContent($notifiable),
            'data' => $notification->getData($notifiable)['body'],
            "priority" => "high"
        ];

        if (!$expoToken) {
            Log::warning('Expo token not found for user ' . $notifiable->id);
            return;
        }

        try {
            self::$client->getClient()->post('', [
                'json' => $message,
            ]);

            UserNotification::create([
                "user_id" => $notifiable->id,
                'header' => $notification->getData($notifiable)['header'],
                'text' => $notification->getContent($notifiable),
                'body' => $notification->getData($notifiable)['body'],
            ]);

            Log::info('Expo notification sent', $message);
        } catch (\Exception $e) {
            Log::error('Error sending Expo notification: ', ['error' => $e->getMessage(), 'message' => $message]);
        }
    }
}
