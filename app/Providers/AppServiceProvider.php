<?php

namespace App\Providers;

use App\Core\Services\Infrastructure\IImageService;
use App\Core\Services\Infrastructure\IMailService;
use App\Core\Services\LocalImageService;
use App\Core\Services\NativeMailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IImageService::class,
            function ($app) {
                return new LocalImageService(public_path('images/'));
            }
        );

        $this->app->bind(
            IMailService::class,
            NativeMailService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
