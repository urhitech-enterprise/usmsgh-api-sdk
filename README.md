# Urhitech SMS PHP SDK & notifications channel for Laravel

The Urhitech SMS PHP SDK provides a suitable approach to the USMSGH API from applications written in PHP. It includes pre-defined set of classes and functions for API resource that initialize themeselves from  API responses.

The library provides other features. For Example:
1. Easy configuration path for fast setup and use
2. Helpers for pagination.


[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/all-my-sms.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/all-my-sms)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/all-my-sms/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/all-my-sms)
[![StyleCI](https://styleci.io/repos/217854455/shield)](https://styleci.io/repos/217854455)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/all-my-sms.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/all-my-sms)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/all-my-sms/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/all-my-sms/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/all-my-sms.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/all-my-sms)

This package also makes it easy to send notifications using [USMSGH](https://www.usmsgh.com) with Laravel 5.5+, 6.x and ^7.x


You can sign up for a USMSGH account at [usmsgh.com](https://www.usmsgh.com)
## Contents

- [Installation](#installation)
    - [Setting up the USMSGH service](#setting-up-the-Usmsgh-service)
- [Usage](#usage)
    - [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Prerequisites
PHP 5.6.0  and later

## Installation
Via [Composer](http://getcomposer.org/)
```
$ composer require usmsgh/usmsgh-api-sdk
```

Via Git Bash
```
git clone git@github.com:urhitech/usmsgh-api-sdk.git
```

## Documentation
Please see [https://usmsgh.com/developer/](https://usmsgh.com/developer/) for up-to-date documentation

## Usage

### Step 1:
If you install the Urhitech SMS PHP SDK via Git Clone then load the Urhitech SMS PHP API class file and use namespace.

```php
require_once '/path/to/src/Usms.php';
use Urhitech\Usms;
```

If you install Urhitech SMS PHP SDK via [Composer](http://getcomposer.org/) the Require the autoload.php file in the index.php of your project or whatever file you need to use Urhitech SMS PHP API classes.

```php
require __DIR__ . '/vendor/autoload.php';
use use Urhitech\Usms;;
```

The Urhitech SMS PHP SDK endpoints are RESTful, and consume and return JSON. All Http endpoints requires an API Key in the request header.

For more information on how to get an API Key visit [here](https://webapp.usmsgh.com/developers) to copy or generate new key for authorization. 

## HTTP ENDPOINTS
* https://webapp.usmsgh.com/api/sms/send
* https://webapp.usmsgh.com/api/sms/{uid}
* https://webapp.usmsgh.com/api/sms
* https://webapp.usmsgh.com/api/me
* https://webapp.usmsgh.com/api/balance
* https://webapp.usmsgh.com/api/contacts
* https://webapp.usmsgh.com/api/contacts/{group_id}/show/
* https://webapp.usmsgh.com/api/contacts/{group_id}
* https://webapp.usmsgh.com/api/contacts/{group_id}/store
* https://webapp.usmsgh.com/api/contacts/{group_id}/search/{uid}
* https://webapp.usmsgh.com/api/contacts/{group_id}/update/{uid}
* https://webapp.usmsgh.com/api/contacts/{group_id}/delete/{uid}
* https://webapp.usmsgh.com/api/contacts/{group_id}/all

For Laravel Usage:

### Setting up the Usmsgh .env

Add the following code to you `.env`:

```env
USMSGH_ENDPOINT=
USMSGH_API_TOKEN=
USMSGH_SENDER=
#USMSGH_UNIVERSAL_TO=

```

### Setting up the Usmsgh service

Add the following code to you `config/services.php`:

```php
// config/services.php
...
'all_my_sms' => [
    'endpoint' => env('USMSGH_ENDPOINT', 'https://webapp.usmsgh.com/api/sms/send'),
    'api_token' => env('USMSGH_API_TOKEN'),
    'sender_id' => env('USMSGH_SENDER'),
    'universal_to' => env('USMSGH_UNIVERSAL_TO'),
],
...
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use Urhitech\Umsmgh\UsmsChannel;
use Urhitech\Umsmgh\UsmsMessage;
use Illuminate\Notifications\Notification;

class ProjectCreated extends Notification
{
    public function via($notifiable)
    {
        return [UsmsChannel::class]; // or 'usmsgh'
    }

    public function toUsms($notifiable)
    {
        return new UsmsMessage('Content');
    }
}
```

In order to let your Notification know which phone number to use, add the `routeNotificationForUsmsgh` method to your Notifiable model.

This method needs to return a phone number.

```php
public function routeNotificationForUsmsgh(Notification $notification)
{
    return $this->phone_number;
}
```

### Local development

When developing an application that sends sms, you probably don't want to actually send sms to live phone numbers. You may set a universal recipient of all sms sent. This can be done by the  `ALL_MY_SMS_UNIVERSAL_TO` environment variable or the `universal_to` option.

### Available Message methods

- `content(string $content)`: Accepts a string value for the sms content.
- `sender(string $sender_id)`: Accepts a string value for the sender name.
- `campaign(string $campaign)`: Accepts a string value for the sms campaign name.
- `sendAt(\DateTimeInterface|string $sendAt)`: Accepts a DateTimeInterface or string for the sms due date.
- `parameters(array $parameters)`: Accepts an array for the sms parameters.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

### Step 2:
Instantiate the UrhitechSMSPHPAPI
```php
$client = new Urhitech\Usms;
```

## Send SMS
```php
$api_key = "Enter Your API Key here";

$url = "https://webapp.usmsgh.com/api/sms/send";

$recipients = "233500000000,233540000000";
$message = "Hello world";
$senderid = "Enter your approved sender ID here";

$response = $client->send_sms($url, $api_key, $senderid, $recipients, $message);
```


## Check SMS Credit Balance
```php
$api_key = "Enter Your API TOKEN here";

$url = "https://webapp.usmsgh.com/api/balance";

$get_credit_balance = $client->check_balance($url, $api_key);
```


## View Profile
```php
$api_key = "Enter Your API Key here";

$url = "https://webapp.usmsgh.com/api/me";

$get_profile = $client->profile($url, $api_key);
```

## Security

If you discover any security related issues, please email supremetechnology2023@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Majesty](https://github.com/majesty2017)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
