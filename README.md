# Laravel Send Stack

[![Latest Version on Packagist](https://img.shields.io/packagist/v/getsendstack/laravel-sendstack.svg?style=flat-square)](https://packagist.org/packages/getsendstack/laravel-sendstack)
[![Test Suite](https://github.com/getsendstack/laravel-sendstack/actions/workflows/tests.yml/badge.svg)](https://github.com/getsendstack/laravel-sendstack/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/getsendstack/laravel-sendstack.svg?style=flat-square)](https://packagist.org/packages/getsendstack/laravel-sendstack)
<!--delete-->

## Installation

You can install the package via composer:

```bash
composer require getsendstack/laravel-sendstack
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="sendstack-config"
```

## Set up

To start using this package, you need to add environment variables for:

- `SENDSTACK_URL` - Optional, not really needed as this has a default
- `SENDSTACK_TOKEN` - You can generate this from your getSendStack account.

The package will pick these up in its configuration and use these when it resolves an instance of the `Client`.

## Usage

This package can be used by injecting the `SendStack\Laravel\Http\Client` into a method to instantiate the client:

```php
declare(strict_types=1);

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SendStack\Laravel\Contracts\ClientContract;

namespace App\Jobs\SendStack;

class SyncSubscribers implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;
    
    public function handle(ClientContract $client): void
    {
        foreach ($client->subscribers()->all() as $subscriber) {
            Subscriber::query()->updateOrCreate(
                attributes: ['email' => $subscriber->email],
                values: $subscriber->toArray(),
            );
        }
    }
}
```

Alternatively you can use the Facade to help you:

```php
declare(strict_types=1);

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SendStack\Laravel\Facades\SendStack;

namespace App\Jobs\SendStack;

class SyncSubscribers implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;
    
    public function handle(): void
    {
        foreach (SendStack::subscribers()->all() as $subscriber) {
            Subscriber::query()->updateOrCreate(
                attributes: ['email' => $subscriber->email],
                values: $subscriber->toArray(),
            );
        }
    }
}
```

### Getting a list of Subscribers

```php
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Facades\SendStack;

/**
 * Without a Facade
 */
$client = app()->make(
    abstract: ClientContract::class,
);

$client->subscribers()->all();

/**
 * Using the Facade
 */
SendStack::subscribers()->all();
```

### Getting a single Subscriber

```php
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Facades\SendStack;

/**
 * Without a Facade
 */
$client = app()->make(
    abstract: ClientContract::class,
);

$client->subscribers()->get(
    query: '1234-1234-1234-1234' // This can be either the subscribers UUID or their Email Address
);

/**
 * Using the Facade
 */
SendStack::subscribers()->get(
    query: '1234-1234-1234-1234', // This can be either the subscribers UUID or their Email Address
);
```

### Creating a new Subscriber

```php
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Facades\SendStack;
use SendStack\Laravel\Http\Requests\SubscriberRequest;

/**
 * Without a Facade
 */
$client = app()->make(
    abstract: ClientContract::class,
);

$client->subscribers()->create(
    request: new SubscriberRequest(
        email: 'contact@getsendstack.com', // Required
        firstName: 'Send', // Optional
        lastName: 'Stack', // Optional
        tags: [
            'Client',
            'Awesome',
        ], // Optional
        optIn: true, // Optional
    ),
);

/**
 * Using the Facade
 */
SendStack::subscribers()->create(
    request: new SubscriberRequest(
        email: 'contact@getsendstack.com', // Required
        firstName: 'Send', // Optional
        lastName: 'Stack', // Optional
        tags: [
            'Client',
            'Awesome',
        ], // Optional
        optIn: true, // Optional
    ),
);
```

### Update a Subscriber

```php
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Facades\SendStack;
use SendStack\Laravel\Http\Requests\SubscriberRequest;

/**
 * Without a Facade
 */
$client = app()->make(
    abstract: ClientContract::class,
);

$client->subscribers()->update(
    uuid: '1234-1234-1234-1234',
    request: new SubscriberRequest(
        email: 'contact@getsendstack.com', // Required
        firstName: 'Send', // Optional
        lastName: 'Stack', // Optional
        tags: [
            'Client',
            'Awesome',
        ], // Optional
        optIn: true, // Optional
    ),
);

/**
 * Using the Facade
 */
SendStack::subscribers()->update(
    uuid: '1234-1234-1234-1234',
    request: new SubscriberRequest(
        email: 'contact@getsendstack.com', // Required
        firstName: 'Send', // Optional
        lastName: 'Stack', // Optional
        tags: [
            'Client',
            'Awesome',
        ], // Optional
        optIn: true, // Optional
    ),
);
```

### Deleting a Subscriber

```php
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Facades\SendStack;

/**
 * Without a Facade
 */
$client = app()->make(
    abstract: ClientContract::class,
);

$client->subscribers()->delete(
    uuid: '1234-1234-1234-1234'
);

/**
 * Using the Facade
 */
SendStack::subscribers()->delete(
    uuid: '1234-1234-1234-1234',
);
```

### Attaching a Tag to a Subscriber

```php
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Facades\SendStack;

/**
 * Without a Facade
 */
$client = app()->make(
    abstract: ClientContract::class,
);

$client->subscribers()->attachTag(
    uuid: '1234-1234-1234-1234',
    tag: 'Early Access',
);

/**
 * Using the Facade
 */
SendStack::subscribers()->attachTag(
    uuid: '1234-1234-1234-1234',
    tag: 'Early Access',
);
```

### Removing a Tag from a Subscriber

```php
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Facades\SendStack;

/**
 * Without a Facade
 */
$client = app()->make(
    abstract: ClientContract::class,
);

$client->subscribers()->removeTag(
    uuid: '1234-1234-1234-1234',
    tag: 'Early Access',
);

/**
 * Using the Facade
 */
SendStack::subscribers()->removeTag(
    uuid: '1234-1234-1234-1234',
    tag: 'Early Access',
);
```

### Getting all Tags

```php
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Facades\SendStack;

/**
 * Without a Facade
 */
$client = app()->make(
    abstract: ClientContract::class,
);

$client->tags()->all();

/**
 * Using the Facade
 */
SendStack::tags()->all();
```

### Creating a new Tag

```php
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Facades\SendStack;
use SendStack\Laravel\Http\Requests\TagRequest;

/**
 * Without a Facade
 */
$client = app()->make(
    abstract: ClientContract::class,
);

$client->tags()->create(
    request: new TagRequest(
        name: 'Test', // Required
        allowFormSubscription: true, // Optional
    ),
);

/**
 * Using the Facade
 */
SendStack::tags()->create(
    request: new TagRequest(
        name: 'Test', // Required
        allowFormSubscription: true, // Optional
    ),
);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Steve McDougall](https://github.com/juststeveking)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
