<?php

declare(strict_types=1);

use SendStack\Laravel\Facades\SendStack;
use SendStack\Laravel\Http\Resources\SubscribersResource;

it('can access the facade', function () {
    expect(
        SendStack::subscribers()
    )->toBeInstanceOf(SubscribersResource::class);
});
