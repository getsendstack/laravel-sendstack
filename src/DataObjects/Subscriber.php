<?php

declare(strict_types=1);

namespace SendStack\Laravel\DataObjects;

use Illuminate\Support\Carbon;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;
use SendStack\Laravel\Enums\Status;

class Subscriber implements DataObjectContract
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $email,
        public readonly Name $name,
        public readonly mixed $meta,
        public readonly array $tags,
        public readonly Status $status,
        public readonly Carbon $confirmed,
        public readonly null|Carbon $unsubscribed,
    ) {
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid,
            'email' => $this->email,
            'name' => $this->name->toArray(),
            'meta' => $this->meta,
            'tags' => array_map(
                callback: fn (Tag $tag): array => $tag->toArray(),
                array: $this->tags,
            ),
            'status' => $this->status->value,
            'confirmed' => $this->confirmed,
            'unsubscribed' => $this->unsubscribed,
        ];
    }
}
