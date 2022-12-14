<?php

declare(strict_types=1);

namespace SendStack\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Http\Resources\SubscribersResource;
use SendStack\Laravel\Http\Resources\TagResource;

/**
 * @method static SubscribersResource subscribers()
 * @method static TagResource tags()
 * @method static bool isActiveSubscriber(string $email)
 *
 * @see ClientContract
 */
class SendStack extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ClientContract::class;
    }
}
