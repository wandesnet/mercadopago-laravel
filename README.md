## Mercado Pago Laravel
<a href="https://github.com/wandesnet/mercadopago-laravel/actions"><img src="https://github.com/wandesnet/mercadopago-laravel/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/wandesnet/mercadopago-laravel"><img src="https://img.shields.io/packagist/dt/wandesnet/mercadopago-laravel" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/wandesnet/mercadopago-laravel"><img src="https://img.shields.io/packagist/v/wandesnet/mercadopago-laravel" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/wandesnet/mercadopago-laravel"><img src="https://img.shields.io/packagist/l/wandesnet/mercadopago-laravel" alt="License"></a>

## Introduction

This integration package with Mercado Pago (not the official one)

Documentation official: https://www.mercadopago.com.br/developers

## Required

- **PHP 8.1+**
- **Laravel 10+**

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
Create a plan
    
```php
    use WandesCardoso\MercadoPago\DTO\Plan;
    use WandesCardoso\MercadoPago\Enums\Currency;
    use WandesCardoso\MercadoPago\Enums\FrequencyType;
    use WandesCardoso\MercadoPago\Enums\PaymentType;
    use WandesCardoso\MercadoPago\Facades\MercadoPago;

    $plan = Plan::make()
            ->setFrequency(1)
            ->setFrequencyType(FrequencyType::MONTHS)
            ->setRepetitions(12)
            ->setBillingDay(15)
            ->setBillingDayProportional(true)
            ->setFreeTrial(30, FrequencyType::DAYS)
            ->setTransactionAmount(100)
            ->setCurrencyId(Currency::BRL)
            ->setReason('Test plan')
            ->setBackUrl('https://mysite.com.br/backurl')
            ->setPaymentMethodsAllowed([PaymentType::CREDIT_CARD, PaymentType::DEBIT_CARD]);
            
    $response = MercadoPago::plan()->create($plan);
    
    var_dump($response);
    
```
Create a subscription
    
```php
    use WandesCardoso\MercadoPago\DTO\Subscription;
    use WandesCardoso\MercadoPago\Enums\Currency;
    use WandesCardoso\MercadoPago\Enums\FrequencyType;
    use WandesCardoso\MercadoPago\Enums\Status;
    use WandesCardoso\MercadoPago\Facades\MercadoPago;

        $subscription = Subscription::make()
            ->setAutoRecurring(
                frequency: 1, //required
                frequencyType: FrequencyType::MONTHS, //required
                startDate: now()->addMonth()->format('Y-m-d\TH:i:s.BP'),
                endDate: now()->addMonths(12)->format('Y-m-d\TH:i:s.BP'),
                amount: 100,
                currency: Currency::BRL, //required
            )
            ->setPreapprovalPlanId('2c938084726fca480172750000000000') //optional
            ->setCredCardTokenId('2c9380848d22f7cc018d2725402d01f8') //required when using preapprovalPlanId
            ->setPayerEmail('test@gmail.com') //required
            ->setReason('Test de subscription')
            ->setStatus(Status::pending) //required
            ->setBackUrl('https://mysite.com.br/backurl'); //required
            
        $response = MercadoPago::subscription()->create($subscription);
        
        var_dump($response);    

```
Update a subscription

```php
    use WandesCardoso\MercadoPago\DTO\Subscription;
    use WandesCardoso\MercadoPago\Enums\Currency;
    use WandesCardoso\MercadoPago\Enums\FrequencyType;
    use WandesCardoso\MercadoPago\Enums\Status;
    use WandesCardoso\MercadoPago\Facades\MercadoPago;

        $subscription = Subscription::make()
            ->setAutoRecurring(
                amount: 100,
                currency: Currency::BRL, 
            )
            ->setCredCardTokenId('2c9380848d22f7cc018d2725402d01f8') 
            ->setReason('Update subscription')
            ->setStatus(Status::pending) 
            ->setBackUrl('https://mysite.com.br/backurl'); 
            
        $response = MercadoPago::subscription()->update(subscription: $subscription, id: '2c938084726fca480172750000000000');
        
        var_dump($response);    

```

## Methods available

The function `mercadoPago()` returns an instance of the class `WandesCardoso\MercadoPago\MercadoPago` that has the following methods:

- `mercadoPago()->payment()->find()`
- `mercadoPago()->payment()->create()`
- `mercadoPago()->payment()->update()`
- `mercadoPago()->payment()->search()`
- `mercadoPago()->preference()->find()`
- `mercadoPago()->preference()->create()`
- `mercadoPago()->preference()->update()`
- `mercadoPago()->preference()->search()`
- `mercadoPago()->plan()->find()`
- `mercadoPago()->plan()->create()`
- `mercadoPago()->plan()->update()`
- `mercadoPago()->plan()->search()`
- `mercadoPago()->request()->get()`
- `mercadoPago()->request()->post()`
- `mercadoPago()->request()->put()`
- `mercadoPago()->request()->delete()`

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email wandes2030@gmail.com
instead of using the issue tracker.

## Tests

    ./vendor/bin/pest

## License MIT. Please see the [license file](LICENSE.md) for more information.

