<?php

declare(strict_types=1);

it('url is not null', function () {
    $url = config()->get('services.sendstack.url');

    expect($url)->not()->toBeEmpty();
});
