<?php

namespace WandesCardoso\MercadoPago\Resource;

use Ramsey\Uuid\Uuid;
use WandesCardoso\MercadoPago\DTO\Payment;
use WandesCardoso\MercadoPago\DTO\PaymentUpdate;

final class AuthorizedPaymentResource extends MpResource
{
    protected string $baseUri = '/authorized_payments';

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
}
