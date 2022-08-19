<?php

declare(strict_types=1);

namespace SendStack\Laravel\Tests;

use SendStack\Laravel\Providers\SendStackServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            SendStackServiceProvider::class,
        ];
    }
}
