<?php

declare(strict_types=1);

namespace SendStack\Laravel\Enums;

enum Status: string
{
    case SUBSCRIBED = 'subscribed';
    case UNSUBSCRIBED = 'unsubscribed';

    public static function match(string $value): Status
    {
        return match ($value) {
            Status::SUBSCRIBED->value => Status::SUBSCRIBED,
            Status::UNSUBSCRIBED->value => Status::UNSUBSCRIBED,
            default => Status::SUBSCRIBED,
        };
    }
}
