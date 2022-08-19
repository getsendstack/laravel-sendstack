<?php

declare(strict_types=1);

namespace SendStack\Laravel\DataObjects;

use JustSteveKing\DataObjects\Contracts\DataObjectContract;

class Name implements DataObjectContract
{
    public function __construct(
        public readonly string $first,
        public readonly string $last,
    ) {
    }

    public function toArray(): array
    {
        return [
            'first' => $this->first,
            'last' => $this->last,
            'full' => "{$this->first} {$this->last}",
        ];
    }
}
