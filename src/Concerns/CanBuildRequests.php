<?php

declare(strict_types=1);

namespace SendStack\Laravel\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use SendStack\Laravel\Http\Client;

/**
 * @mixin Client
 */
trait CanBuildRequests
{
    public function makeRequest(): PendingRequest
    {
        return Http::baseUrl(
            url: $this->url(),
        )->timeout(
            seconds: 15,
        )->withUserAgent(
            userAgent: 'Laravel_SendStack_Package_v1',
        )->withToken(
            token: $this->token(),
        );
    }
}
