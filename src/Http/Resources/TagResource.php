<?php

declare(strict_types=1);

namespace SendStack\Laravel\Http\Resources;

use JustSteveKing\DataObjects\Contracts\DataObjectContract;
use SendStack\Laravel\Collections\TagCollection;
use SendStack\Laravel\DataObjects\Tag;
use SendStack\Laravel\Enums\Method;
use SendStack\Laravel\Exceptions\SendStackApiException;
use SendStack\Laravel\Http\Requests\TagRequest;

class TagResource extends SendStackResource
{
    public function all(): TagCollection
    {
        $response = $this->client->send(
            method: Method::GET,
            url   : '/tags',
        );

        if ($response->failed()) {
            throw new SendStackApiException(
                response: $response,
            );
        }

        return TagCollection::make(
            items: array_map(
                callback: fn (string $tag): mixed => $this->buildTag(
                    data: $tag
                ),
                array: (array) $response->json('data'),
            ),
        );
    }

    public function create(TagRequest $request): DataObjectContract
    {
        $response = $this->client->send(
            method: Method::POST,
            url: '/tags',
            options: [
                'json' => $request->toArray(),
            ]
        );

        if ($response->failed()) {
            throw new SendStackApiException(
                response: $response,
            );
        }

        return $this->buildTag(
            data: strval($response->collect()->first()),
        );
    }

    protected function buildTag(string $data): DataObjectContract
    {
        return new Tag(
            name: $data,
        );
    }
}
