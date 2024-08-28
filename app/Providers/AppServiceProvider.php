<?php

namespace App\Providers;

use App\Services\Interfaces\IQueryHelper;
use App\Services\QueryHelper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            IQueryHelper::class,
            QueryHelper::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
