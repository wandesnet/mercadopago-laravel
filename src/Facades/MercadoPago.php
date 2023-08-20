<?php

namespace WandesCardoso\MercadoPago\Facades;

use Illuminate\Support\Facades\Facade;
use WandesCardoso\MercadoPago\Resource\MpResource;
use WandesCardoso\MercadoPago\Resource\PaymentResource;
use WandesCardoso\MercadoPago\Resource\PreferenceResource;

/**
 * @method static MpResource request()
 * @method static PaymentResource payment()
 * @method static PreferenceResource preference()
 */
class MercadoPago extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mercadopago';
    }
}
