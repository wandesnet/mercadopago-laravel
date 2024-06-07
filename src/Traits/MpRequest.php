<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoPago\Traits;

use WandesCardoso\MercadoPago\Resource\InvoiceResource;
use WandesCardoso\MercadoPago\Resource\MpResource;
use WandesCardoso\MercadoPago\Resource\PaymentResource;
use WandesCardoso\MercadoPago\Resource\PlanResource;
use WandesCardoso\MercadoPago\Resource\PreferenceResource;
use WandesCardoso\MercadoPago\Resource\SubscriptionResource;

trait MpRequest
{
    public function request(): MpResource
    {
        return new MpResource($this);
    }

    public function payment(): PaymentResource
    {
        return new PaymentResource($this);
    }

    public function invoice(): InvoiceResource
    {
        return new InvoiceResource($this);
    }

    public function preference(): PreferenceResource
    {
        return new PreferenceResource($this);
    }

    public function plan(): PlanResource
    {
        return new PlanResource($this);
    }

    public function subscription(): SubscriptionResource
    {
        return new SubscriptionResource($this);
    }
}
