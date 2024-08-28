<?php

namespace App\Providers;

use App\Repositories\Comment\ICommentRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Notification\INotificationRepository;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\UserSettings\IUserSettingsRepository;
use App\Repositories\UserSettings\UserSettingsRepository;
use App\Repositories\UserVerifier\IUserVerifierRepository;
use App\Repositories\UserVerifier\UserVerifierRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {




        // $this->app->bind(
        //     INotificationRepository::class,
        //     NotificationRepository::class
        // );


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
