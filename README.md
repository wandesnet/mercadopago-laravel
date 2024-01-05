## Mercado Pago Laravel
<a href="https://github.com/wandesnet/mercadopago-laravel/actions"><img src="https://github.com/wandesnet/mercadopago-laravel/workflows/run-tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/wandesnet/mercadopago-laravel"><img src="https://img.shields.io/packagist/dt/wandesnet/mercadopago-laravel" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/wandesnet/mercadopago-laravel"><img src="https://img.shields.io/packagist/v/wandesnet/mercadopago-laravel" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/wandesnet/mercadopago-laravel"><img src="https://img.shields.io/packagist/l/wandesnet/mercadopago-laravel" alt="License"></a>

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

$mp = MercadoPago::payment()->find('1232324');

var_dump($mp);

```
Create a payment

```php
use WandesCardoso\MercadoPago\Facades\MercadoPago;
use WandesCardoso\MercadoPago\DTO\Item;
use WandesCardoso\MercadoPago\DTO\Payer;
use WandesCardoso\MercadoPago\DTO\Payment;

    $payer = new Payer(
            'test_user@testuser.com'
        );

    
    $item = Item::make()
                ->setTitle('title product')
                ->setQuantity(1)
                ->setUnitPrice(100)
                ->setDescription('description product')
                ->setPictureUrl('https://www.mercadopago.com/org-img/MP3/home/logomp3.gif')
                ->setCategoryId('electronics');

    $payment = Payment::make()
                ->setPayer($payer)
                ->addItem($item)
                ->setPaymentMethodId('pix')
                ->setExternalReference('123434567');

    $response = MercadoPago::payment()->create($payment);

    var_dump($response);
```
Crate a preference

```php
use WandesCardoso\MercadoPago\Facades\MercadoPago;
use WandesCardoso\MercadoPago\DTO\Item;
use WandesCardoso\MercadoPago\DTO\BackUrls;
use WandesCardoso\MercadoPago\DTO\Payer;
use WandesCardoso\MercadoPago\DTO\Preference;

        $payer = new Payer(
                    'test_user@testuser.com',
                );


        $item = Item::make()
                    ->setTitle('Title product 2')
                    ->setQuantity(1)
                    ->setUnitPrice(120)
                    ->setDescription('description product 2')
                    ->setPictureUrl('https://www.mercadopago.com/org-img/MP3/home/logomp3.gif')
                    ->setCategoryId('electronics');

        $preference = Preference::make()
                    ->setPayer($payer)
                    ->addItem($item)
                    ->setBackUrls(new BackUrls(
                        'https://www.mysite.com.br?success',
                        'https://www.mysite.com.br?pending',
                        'https://www.mysite.com.br?failure',
                    ))
                    ->setExternalReference('20');


        $response = MercadoPago::preference()->create($preference);

        var_dump($response);
                    
                    
```

## Methods available

- `request()->payment()->find()`
- `request()->payment()->create()`
- `request()->payment()->update()`
- `request()->payment()->search()`
- `request()->preference()->find()`
- `request()->preference()->create()`
- `request()->preference()->update()`
- `request()->preference()->search()`
- `request()->get()`
- `request()->post()`
- `request()->put()`
- `request()->delete()`

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email wandes2030@gmail.com
instead of using the issue tracker.

## Tests

    ./vendor/bin/pest

## License MIT. Please see the [license file](LICENSE.md) for more information.

