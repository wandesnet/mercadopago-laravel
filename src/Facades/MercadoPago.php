<?php

namespace WandesCardoso\MercadoPago\Facades;

use Illuminate\Support\Facades\Facade;
use WandesCardoso\MercadoPago\Resource\MpResource;

/**
 * @method static MpResource request()
 */
class MercadoPago extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mercadopago';
    }
}
