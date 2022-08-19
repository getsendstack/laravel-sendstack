<?php

declare(strict_types=1);

namespace SendStack\Laravel\Enums;

enum Status: string
{
    case SUBSCRIBED = 'subscribed';
    case PENDING = 'pending';

    public static function match(string $value): Status
    {
        return match ($value) {
            Status::SUBSCRIBED->value => Status::SUBSCRIBED,
            Status::PENDING->value => Status::PENDING,
            default => Status::SUBSCRIBED,
        };
    }
}
