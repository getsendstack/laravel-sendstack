<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use SendStack\Laravel\Http\Client;
use SendStack\Laravel\Tests\TestCase;
use JustSteveKing\StatusCode\Http as Status;

uses(TestCase::class)->in('Feature');

function fakeClient(null|array $body): void
{
    Client::fake(['*' => Http::response(
        body:   $body,
        status: Status::OK(),
    )]);
}
