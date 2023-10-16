# Monnify-PHP-SDK - DEv

Monnify-PHP-SDK is a PHP wrapper for interacting with the Monnify API. It allows developers to seamlessly integrate Monnify's payment and financial services into their PHP applications.

## Installation

You can install this SDK using Composer:

```bash
composer require your-namespace/monnify-php-sdk
```



## Configuration
To use the Monnify-PHP-SDK, you need to configure it with your Monnify API credentials:

```php
use Monnify\Monnify;

$config = [
    'api_key' => 'Your-API-Key',
    'api_secret' => 'Your-API-Secret',
    'api_url' => 'https://api.monnify.com',
    'test' => true, // Set to true for testing environment
];

$monnify = new Monnify($config);

```

## Documentation

For more details and API reference, please refer to the [official Monnify documentation](https://developer.monnify.com/).

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
