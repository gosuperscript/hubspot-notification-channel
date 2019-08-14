# Laravel Hubspot Notification Channel

This package makes it easy to send Hubspot (Single Send Email) notifications with Laravel.

## Installation

You can install the package via composer:

``` bash
composer require digitalrisks/hubspot-notification-channel
```

Add the service provider (only required on Laravel 5.4 or lower):

```php
// config/app.php
'providers' => [
    ...
    DigitalRisks\Notifications\ServiceProvider::class,
],
```

### Setting up your Hubspot account

Add your Hubspot key to your `config/services.php`:

```php
// config/services.php
...
'hubspot' => [
    'key' => env('HUBSPOT_KEY', null),
    'template_id' => env('TEMPLATE_NAME_ID', null)
],
...
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
<?php

namespace App\Notifications;

use DigitalRisks\Notifications\Messages\HubspotMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SomethingHappened extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['hubspot'];
    }

    /**
     * Get the hubspot representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \DigitalRisks\Notifications\Messages\HubspotMessage
     */
    public function toMail($notifiable)
    {
        return (new HubspotMessage)
            ->templateId(config('services.hubspot.template_id'))
            ->contactProperties([])
            ->customProperties([]);
    }
}
```

## Setting up the to field.
``` php
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * Route notifications for the Hubspot channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForHubspot($notification)
    {
        return $this->email;
    }
}
```


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email kani.robinson@digitalrisks.co.uk instead of using the issue tracker.

## Credits

- [Kani Robinson](https://github.com/kanirobinson)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
