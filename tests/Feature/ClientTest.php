<?php

declare(strict_types=1);

use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Http\Client;

it('can manually create a client', function (string $string) {
    expect(
        new Client(
            url: $string,
            token: $string,
        ),
    )->toBeInstanceOf(ClientContract::class);
})->with('strings');

it('can resolve a client from the Laravel container', function () {
    $client = app()->make(
        abstract: ClientContract::class,
    );

    expect(
        $client,
    )->toBeInstanceOf(Client::class);
});
