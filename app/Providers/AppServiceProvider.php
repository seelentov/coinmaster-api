<?php

namespace App\Providers;

use App\Services\Interfaces\INewsService;
use App\Services\Interfaces\IQueryHelper;
use App\Services\Interfaces\IValuteService;
use App\Services\NewsService;
use App\Services\QueryHelper;
use App\Services\ValuteService;
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
        $this->app->bind(
            IValuteService::class,
            ValuteService::class
        );
        $this->app->bind(
            INewsService::class,
            NewsService::class
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
