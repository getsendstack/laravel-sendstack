<?php

declare(strict_types=1);

namespace SendStack\Laravel\Concerns;

use Illuminate\Http\Client\Response;
use SendStack\Laravel\Http\Client;
use SendStack\Laravel\Enums\Method;

/**
 * @mixin Client
 */
trait CanSendRequests
{
    public function send(
        Method $method,
        string $url,
        array $options = [],
    ): Response {
        return $this
            ->makeRequest()
            ->send(
                method: $method->value,
                url: $url,
                options: $options,
            );
    }
}
