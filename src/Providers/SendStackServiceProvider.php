<?php

declare(strict_types=1);

namespace SendStack\Laravel\Providers;

use Illuminate\Support\ServiceProvider;
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Http\Client;

class SendStackServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(
            path: __DIR__.'/../../config/services.php',
            key: config_path(
                path: 'services',
            )
        );
    }

    public function register(): void
    {
        $this->app->singleton(
            abstract: ClientContract::class,
            concrete: fn (): ClientContract => new Client(
                url: strval(config('services.sendstack.url')),
                token: strval(config('services.sendstack.token')),
            ),
        );
    }
}
