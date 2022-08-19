<?php

declare(strict_types=1);

namespace SendStack\Laravel\Http\Resources;

use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Contracts\ResourceContract;

class SendStackResource implements ResourceContract
{
    public function __construct(
        protected readonly ClientContract $client,
    ) {
    }
}
