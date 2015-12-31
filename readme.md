This is a Laravel 5 package that provides reward management facility for lavalite framework.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `petfinder/reward`.

    "petfinder/reward": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes execute below cammnds in command line to finalize installation.

```php
Petfinder\Reward\Providers\RewardServiceProvider::class,

```

And also add it to alias

```php
'Reward'  => Petfinder\Reward\Facades\Reward::class,
```

Use the below commands for publishing

Migration and seeds

    php artisan vendor:publish --provider="Petfinder\Reward\Providers\RewardServiceProvider" --tag="migrations"
    php artisan vendor:publish --provider="Petfinder\Reward\Providers\RewardServiceProvider" --tag="seeds"

Configuration

    php artisan vendor:publish --provider="Petfinder\Reward\Providers\RewardServiceProvider" --tag="config"

Language

    php artisan vendor:publish --provider="Petfinder\Reward\Providers\RewardServiceProvider" --tag="lang"

Views public and admin

    php artisan vendor:publish --provider="Petfinder\Reward\Providers\RewardServiceProvider" --tag="view-public"
    php artisan vendor:publish --provider="Petfinder\Reward\Providers\RewardServiceProvider" --tag="view-admin"

Publish admin views only if it is necessary.

## Usage


