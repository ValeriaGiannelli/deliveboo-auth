<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $this->app->singleton(Gateway::class, function ($app){

            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'sk99b39k2yysryqj',
                    'publicKey' => 'p3s27wjdv9hq28nn',
                    'privateKey' => '87d0c683341e48dfdd0da237a574776d'
                ]
            );

        });
    }
}
