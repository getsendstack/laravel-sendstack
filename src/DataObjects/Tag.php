<?php

declare(strict_types=1);

namespace SendStack\Laravel\DataObjects;

use JustSteveKing\DataObjects\Contracts\DataObjectContract;

class Tag implements DataObjectContract
{
    public function __construct(
        public readonly string $name,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
