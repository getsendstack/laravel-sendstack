<?php

declare(strict_types=1);

namespace SendStack\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use SendStack\Laravel\Http\Client;
use SendStack\Laravel\Http\Resources\SubscribersResource;
use SendStack\Laravel\Http\Resources\TagResource;

/**
 * @method static SubscribersResource subscribers()
 * @method static TagResource tags()
 *
 * @see Client
 */
class SendStack extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
