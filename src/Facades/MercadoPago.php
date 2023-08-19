<?php

namespace WandesCardoso\MercadoPago\Facades;

use Illuminate\Support\Facades\Facade;
use WandesCardoso\MercadoPago\Resource\MpResource;
use WandesCardoso\MercadoPago\Resource\PaymentResource;

/**
 * @method static MpResource request()
 * @method static PaymentResource payment()
 */
class MercadoPago extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mercadopago';
    }
}
