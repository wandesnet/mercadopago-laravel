<?php

namespace WandesCardoso\MercadoPago\Facades;

use Illuminate\Support\Facades\Facade;
use WandesCardoso\MercadoPago\Resource\InvoiceResource;
use WandesCardoso\MercadoPago\Resource\MpResource;
use WandesCardoso\MercadoPago\Resource\PaymentResource;
use WandesCardoso\MercadoPago\Resource\PlanResource;
use WandesCardoso\MercadoPago\Resource\PreferenceResource;
use WandesCardoso\MercadoPago\MercadoPago as CoreMercadoPago;

/**
 * @method static MpResource request()
 * @method static PaymentResource payment()
 * @method static PreferenceResource preference()
 * @method static PlanResource plan()
 * @method static InvoiceResource invoice()
 * @method static CoreMercadoPago make(mixed ...$arguments)
 */
class MercadoPago extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mercadopago';
    }
}
