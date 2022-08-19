<?php

declare(strict_types=1);

return [
    'sendstack' => [
        'url' => env('SENDSTACK_URL', 'https://getsendstack.com/api'),
        'token' => env('SENDSTACK_TOKEN'),
    ],
];
