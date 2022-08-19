<?php

declare(strict_types=1);

namespace SendStack\Laravel\Http\Requests;

use JustSteveKing\DataObjects\Contracts\DataObjectContract;

class SubscriberRequest implements DataObjectContract
{
    public function __construct(
        protected readonly string $email,
        protected readonly null|string $firstName = null,
        protected readonly null|string $lastName = null,
        protected readonly null|array $tags = null,
        protected readonly null|bool $optIn = null
    ) {
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'tags' => $this->tags,
            'optin' => $this->optIn,
        ];
    }
}
