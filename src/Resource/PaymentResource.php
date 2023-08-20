<?php

namespace WandesCardoso\MercadoPago\Resource;

use WandesCardoso\MercadoPago\DTO\Payment;
use WandesCardoso\MercadoPago\DTO\PaymentUpdate;

final class PaymentResource extends MpResource
{
    protected string $baseUri = '/v1/payments';

    /**
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function search(array $params): array
    {
        return $this->get("/{$this->baseUri}/search", $params);
    }

    /** @return array<string, mixed> */
    public function find(string $id): array
    {
        return $this->get("/{$this->baseUri}/{$id}");
    }

    /**
     * @param Payment $payment
     * @return array<string, mixed>
     */
    public function create(Payment $payment): array
    {
        return $this->post($this->baseUri, $payment->toArray());
    }

    /**
     * @param PaymentUpdate $payment
     * @return array<string, mixed>
     */
    public function update(PaymentUpdate $payment, string $id): array
    {
        return $this->put("/{$this->baseUri}/{$id}", $payment->toArray());
    }
}
