<?php

namespace App\Providers;

use Illuminate\Notifications\DatabaseNotification as BaseNotification;

use Illuminate\Support\ServiceProvider;
use Stripe\StripeClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        $this->app->singleton(StripeClient::class,  function(){
            return new StripeClient(config('stripe.secret'));
        });


    }
}
