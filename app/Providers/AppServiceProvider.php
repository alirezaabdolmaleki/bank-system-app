<?php

namespace App\Providers;

use App\Services\Messaging\Drivers\Ghasedak;
use App\Services\Messaging\Drivers\KavehNegar;
use App\Services\Messaging\MessagingStrategyInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MessagingStrategyInterface::class, function ($app) {
            $provider = config('sms.default');

            if ($provider === 'kaveh_negar') {
                return new KavehNegar();
            }

            return new Ghasedak();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
