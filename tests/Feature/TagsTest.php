<?php

declare(strict_types=1);

use SendStack\Laravel\Collections\TagCollection;
use SendStack\Laravel\DataObjects\Tag;
use SendStack\Laravel\Http\Client;
use SendStack\Laravel\Http\Requests\TagRequest;

it('can get a list of tags', function (string $string) {
    fakeClient(
        body: [
            'data' => [
                $string,
                "$string test",
            ]
        ],
    );

    $client = new Client(
        url: $string,
        token: $string,
    );

    expect(
        $client->tags()->all(),
    )->toBeInstanceOf(
        TagCollection::class
    )->each(
        fn ($tag) =>
        $tag
            ->toBeInstanceOf(Tag::class),
    );
})->with('strings');

it('can create a new tag', function (string $string) {
    fakeClient(
        body: [$string],
    );

    $client = new Client(
        url: $string,
        token: $string,
    );

    expect(
        $client->tags()->create(
            request: new TagRequest(
                name: $string,
            ),
        ),
    )->toBeInstanceOf(Tag::class);
})->with('strings');
