<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Contracts\PaymentDto;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class Payment implements PaymentDto
{
    use Makeable;

    /** @var array<string, mixed> */
    private array $payload;

    public function __construct()
    {
        $this->payload = [
            'additional_info' => [],
            'payer' => [],
            'metadata' => [],
        ];
    }

    /** @param  array<Item>|Item $item */
    public function addItem(array|Item $item): self
    {

        if ( ! is_array($item)) {
            $item = [$item];
        }

        $totalTransactionAmount = 0;

        foreach ($item as $singleItem) {
            if ( ! $singleItem instanceof Item) {
                throw new \InvalidArgumentException('Invalid item provided.');
            }

            $this->payload['additional_info']['items'][] = $singleItem->toArray(); //@phpstan-ignore-line

            $totalTransactionAmount += $singleItem->getTotalAmount();
        }

        return $this->setTransactionAmount($totalTransactionAmount);
    }

    public function setPayer(Payer $payer): self
    {

        $this->payload['additional_info']['payer'] = $payer->toArray()['additional_info']; //@phpstan-ignore-line
        $this->payload['payer'] = $payer->toArray()['payer'];
        $this->payload['additional_info']['shipments']['receiver_address'] = $payer->toArray()['address']; // @phpstan-ignore-line

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->payload['description'] = $description;

        return $this;
    }

    public function setExternalReference(string $externalReference): self
    {
        $this->payload['external_reference'] = $externalReference;

        return $this;
    }

    public function setInstallments(int $installments): self
    {
        $this->payload['installments'] = $installments;

        return $this;
    }

    public function setPaymentMethodId(string $paymentMethodId): self
    {
        $this->payload['payment_method_id'] = $paymentMethodId;

        return $this;
    }

    public function setToken(string $token): self
    {
        $this->payload['token'] = $token;

        return $this;
    }

    public function setIssuer_id(string $issuer_id): self
    {
        $this->payload['issuer_id'] = $issuer_id;

        return $this;
    }

    public function setTransactionAmount(float $transactionAmount): self
    {
        $this->payload['transaction_amount'] = $transactionAmount;

        return $this;
    }

    public function setNotificationUrl(string $notificationUrl): self
    {
        $this->payload['notification_url'] = $notificationUrl;

        return $this;
    }

    public function setStatementDescriptor(string $statementDescriptor): self
    {
        $this->payload['statement_descriptor'] = $statementDescriptor;

        return $this;
    }

    public function setBinaryMode(bool $binaryMode): self
    {
        $this->payload['binary_mode'] = $binaryMode;

        return $this;
    }

    public function setCallbackUrl(string $callbackUrl): self
    {
        $this->payload['callback_url'] = $callbackUrl;

        return $this;
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return $this->payload;
    }
}
