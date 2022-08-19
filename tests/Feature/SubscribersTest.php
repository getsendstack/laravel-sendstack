<?php

declare(strict_types=1);

use SendStack\Laravel\Collections\SubscriberCollection;
use SendStack\Laravel\DataObjects\Subscriber;
use SendStack\Laravel\Http\Client;
use SendStack\Laravel\Http\Requests\SubscriberRequest;

it('can get a list of subscribers', function (string $string) {
    fakeClient(
        body: [
            'data' => [
                [
                    'uuid' => $string,
                    'email' => $string,
                    'first_name' => $string,
                    'last_name' => $string,
                    'meta' => $string,
                    'tags' => [$string],
                    'status' => 'subscibed',
                    'confirmed_at' => now(),
                    'unsubscribed_at' => null,
                ],
                [
                    'uuid' => $string,
                    'email' => $string,
                    'first_name' => $string,
                    'last_name' => $string,
                    'meta' => $string,
                    'tags' => [$string],
                    'status' => 'subscibed',
                    'confirmed_at' => now()->subDays(),
                    'unsubscribed_at' => null,
                ],
            ],
        ],
    );

    $client = new Client(
        url: $string,
        token: $string,
    );

    expect(
        $client->subscribers()->all(),
    )->toBeInstanceOf(
        SubscriberCollection::class
    )->each(
        fn ($subscriber) =>
        $subscriber
            ->toBeInstanceOf(Subscriber::class),
    );
})->with('strings');

it('can get a single subscriber', function (string $string) {
    fakeClient(
        body: [
            'uuid' => $string,
            'email' => $string,
            'first_name' => $string,
            'last_name' => $string,
            'meta' => $string,
            'tags' => [$string],
            'status' => 'subscibed',
            'confirmed_at' => now(),
            'unsubscribed_at' => null,
        ],
    );

    $client = new Client(
        url: $string,
        token: $string,
    );

    expect(
        $client->subscribers()->get(query: $string),
    )->toBeInstanceOf(
        Subscriber::class
    );
})->with('strings');

it('can create a new subscriber', function (string $string) {
    fakeClient(
        body: [
            'uuid' => $string,
            'email' => $string,
            'first_name' => $string,
            'last_name' => $string,
            'meta' => $string,
            'tags' => [$string],
            'status' => 'subscibed',
            'confirmed_at' => now(),
            'unsubscribed_at' => null,
        ],
    );

    $client = new Client(
        url: $string,
        token: $string,
    );

    expect(
        $client->subscribers()->create(
            request: new SubscriberRequest(
                email: $string,
                firstName: $string,
                lastName: $string,
                tags: [$string],
                optIn: true,
            ),
        ),
    )->toBeInstanceOf(Subscriber::class);
})->with('strings');

it('can update a subscriber', function (string $string) {
    fakeClient(
        body: [
            'uuid' => $string,
            'email' => $string,
            'first_name' => $string,
            'last_name' => $string,
            'meta' => $string,
            'tags' => [$string],
            'status' => 'subscibed',
            'confirmed_at' => now(),
            'unsubscribed_at' => null,
        ],
    );

    $client = new Client(
        url: $string,
        token: $string,
    );

    expect(
        $client->subscribers()->update(
            uuid: $string,
            request: new SubscriberRequest(
                email: $string,
                optIn: false,
            ),
        )
    )->toBeInstanceOf(Subscriber::class);
})->with('strings');

it('can delete a subscriber', function (string $string) {
    fakeClient(
        body: null,
    );

    $client = new Client(
        url: $string,
        token: $string,
    );

    expect(
        $client->subscribers()->delete(
            uuid: $string,
        )
    )->toBeBool()->toEqual(true);
})->with('strings');

it('can check if an email is an active subscriber', function (string $string) {
    fakeClient(
        body: [
            'uuid' => $string,
            'email' => $string,
            'first_name' => $string,
            'last_name' => $string,
            'meta' => $string,
            'tags' => [$string],
            'status' => 'subscibed',
            'confirmed_at' => now(),
            'unsubscribed_at' => null,
        ],
    );

    $client = new Client(
        url: $string,
        token: $string,
    );

    expect(
        $client->isActiveSubscriber(
            email: $string,
        ),
    )->toBeBool()->toEqual(true);
})->with('strings');

it('can check if an email is an inactive subscriber', function (string $string) {
    fakeClient(
        body: [
                  'uuid' => $string,
                  'email' => $string,
                  'first_name' => $string,
                  'last_name' => $string,
                  'meta' => $string,
                  'tags' => [$string],
                  'status' => 'pending',
                  'confirmed_at' => now(),
                  'unsubscribed_at' => null,
              ],
    );

    $client = new Client(
        url: $string,
        token: $string,
    );

    expect(
        $client->isActiveSubscriber(
            email: $string,
        ),
    )->toBeBool()->toEqual(false);
})->with('strings');
