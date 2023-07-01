<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoPago\Traits;

use WandesCardoso\MercadoPago\Resource\MpResource;

trait MpRequestTrait
{
    public function request(): MpResource
    {
        return new MpResource($this);
    }
}
