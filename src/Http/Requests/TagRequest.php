<?php

declare(strict_types=1);

namespace SendStack\Laravel\Http\Requests;

use JustSteveKing\DataObjects\Contracts\DataObjectContract;

class TagRequest implements DataObjectContract
{
    public function __construct(
        protected readonly string $name,
        protected readonly null|bool $allowFormSubscription = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'allow_form_subscription' => $this->allowFormSubscription,
        ];
    }
}
