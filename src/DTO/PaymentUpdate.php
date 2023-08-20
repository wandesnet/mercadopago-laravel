<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Contracts\Arrayable;
use WandesCardoso\MercadoPago\Enums\Status;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class PaymentUpdate implements Arrayable
{
    use Makeable;

    /** @param  array<string, mixed>  $payload */
    public function __construct(private array $payload = [])
    {
    }

    public function setTransactionAmount(float $transactionAmount): self
    {
        $this->payload['transaction_amount'] = $transactionAmount;

        return $this;
    }

    public function setCapture(bool $capture): self
    {
        $this->payload['capture'] = $capture;

        return $this;
    }

    public function setStatus(Status $status): self
    {
        $this->payload['status'] = $status;

        return $this;
    }

    public function setDateOfExpiration(string $dateOfExpiration): self
    {
        $this->payload['date_of_expiration'] = $dateOfExpiration;

        return $this;
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return $this->payload;
    }
}
