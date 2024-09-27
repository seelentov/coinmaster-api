<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ExpoNotification;
use App\Notifications\Facades\ExpoChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendExpoNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $notification;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, ExpoNotification $notification)
    {
        $this->user = $user;
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ExpoChannel::send($this->user, $this->notification);
    }
}
