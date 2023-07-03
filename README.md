## Introduction

This integration package with Mercado Pago (not the official one)

Documentation official: https://www.mercadopago.com.br/developers

## Required

- **PHP 8.1+**

## To get started, using the Composer package manager

    composer require wandesnet/mercadopago-laravel
Next, publish resources using the vendor:publish command:

    php artisan vendor:publish --provider="WandesCardoso\MercadoPago\MercadoPagoServiceProvider" 

## Configuration

After publishing the resources, its configuration file will be located at `.env`. This file allows you to configure the credentials of your Mercado Pago application.

```php
MP_ACCESS_TOKEN=
```
    
## Usage

```php
use WandesCardoso\MercadoPago\Facades\MercadoPago;

$mp = MercadoPago::request()->payment('123232');

var_dump($mp);

```

## Methods available

- `request()->payment('123232')`
- `request()->get('payment/123232')`
- `request()->post('payment', ['external_reference' => '123232'])`
- `request()->put('payment/123232', ['external_reference' => '123232'])`
- `request()->delete('payment/123232')`

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email wandes2030@gmail.com
instead of using the issue tracker.

## Tests

    ./vendor/bin/pest

## License MIT. Please see the [license file](LICENSE.md) for more information.

