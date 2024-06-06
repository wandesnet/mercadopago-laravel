<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoPago\Traits;

use WandesCardoso\MercadoPago\Resource\AuthorizedPaymentResource;
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

    public function authorized_payment(): AuthorizedPaymentResource
    {
        return new AuthorizedPaymentResource($this);
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
