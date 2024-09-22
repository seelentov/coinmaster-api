<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExpoNotification extends Notification
{
    use Queueable;

    public $header;
    public $text;
    public $body;

    /**
     * Create a new notification instance.
     *
     * @param  string  $header
     * @param  string  $text
     * @param  array  $body
     * @return void
     */
    public function __construct($header, $text, $body)
    {
        $this->header = $header;
        $this->text = $text;
        $this->body = $body;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['expo'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'user_id' => $notifiable->id,
            'header' => $this->header,
            'text' => $this->text,
            'body' => $this->body,
        ];
    }

    public function getContent($notifiable)
    {
        return $this->text;
    }

    /**
     * Get the data for the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function getData($notifiable)
    {
        return [
            'header' => $this->header,
            'body' => $this->body,
        ];
    }
}
