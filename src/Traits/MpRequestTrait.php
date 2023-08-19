<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoPago\Traits;

use WandesCardoso\MercadoPago\Resource\MpResource;
use WandesCardoso\MercadoPago\Resource\PaymentResource;

trait MpRequestTrait
{
    public function request(): MpResource
    {
        return new MpResource($this);
    }

    public function payment(): PaymentResource
    {
        return new PaymentResource($this);
    }
}
