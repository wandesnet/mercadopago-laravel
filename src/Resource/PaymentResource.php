<?php

namespace WandesCardoso\MercadoPago\Resource;

use WandesCardoso\MercadoPago\Contracts\PaymentDto;

final class PaymentResource extends MpResource
{
    /** @return array<string, mixed> */
    public function find(string $id): array
    {
        return $this->get("/payments/{$id}");
    }

    /**
     * @param PaymentDto $payment
     * @return array<string, mixed>
     */
    public function create(PaymentDto $payment): array
    {
        return $this->post('/payments', $payment->toArray());
    }
}
