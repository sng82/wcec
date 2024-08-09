<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use URL;

//use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        if (config('app.url') === 'https://wcec.sys') {
//            URL::forceScheme('https');
//        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set default password requirements for users
        Password::defaults(function () {
            $rule = Password::min(8);

            return $this->app->isProduction()
                ? $rule->letters()->numbers()->uncompromised()
                : $rule;
        });

        // https://laravel.com/docs/11.x/billing#tax-configuration
//        Cashier::calculateTaxes();
    }
}
