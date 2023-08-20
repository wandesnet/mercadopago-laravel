<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Contracts\PaymentDto;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class Preference implements PaymentDto
{
    use Makeable;

    /** @var array<string, mixed> */
    private array $payload;

    public function __construct()
    {
        $this->payload = [
            'items' => [],
            'payer' => [],
        ];
    }

    /** @param  array<Item>|Item $item */
    public function addItem(array|Item $item): self
    {

        if ( ! is_array($item)) {
            $item = [$item];
        }

        foreach ($item as $singleItem) {
            if ( ! $singleItem instanceof Item) {
                throw new \InvalidArgumentException('Invalid item provided.');
            }

            $this->payload['items'][] = $singleItem->toArray(); // @phpstan-ignore-line

        }

        return $this;
    }

    public function setPayer(Payer $payer): self
    {
        $this->payload['payer'] = $payer->toArray()['preferences'];

        return $this;
    }

    public function setAdditionalInfo(string $additionalInfo): self
    {
        $this->payload['additional_info'] = $additionalInfo;

        return $this;
    }

    public function setExternalReference(string $externalReference): self
    {
        $this->payload['external_reference'] = $externalReference;

        return $this;
    }

    public function setAutoReturn(string $autoReturn): self
    {
        $this->payload['auto_return'] = $autoReturn;

        return $this;
    }

    /** @param  BackUrls  $backUrls */
    public function setBackUrls(BackUrls $backUrls): self
    {
        $this->payload['back_urls'] = $backUrls->toArray();

        return $this;
    }

    public function setNotificationUrl(string $notificationUrl): self
    {
        $this->payload['notification_url'] = $notificationUrl;

        return $this;
    }

    public function setPaymentMethods(PaymentMethods $paymentMethods): self
    {
        $this->payload['payment_methods'] = $paymentMethods->toArray();

        return $this;
    }

    public function setShipments(Shipments $shipments): self
    {
        $this->payload['shipments'] = $shipments->toArray();

        return $this;
    }

    public function setStatementDescriptor(string $statementDescriptor): self
    {
        $this->payload['statement_descriptor'] = $statementDescriptor;

        return $this;
    }

    public function setMarketplace(string $marketplace): self
    {
        $this->payload['marketplace'] = $marketplace;

        return $this;
    }

    public function setMarketplaceFee(float $marketplaceFee): self
    {
        $this->payload['marketplace_fee'] = $marketplaceFee;

        return $this;
    }

    public function setExpirationDateFrom(string $expirationDateFrom): self
    {
        $this->payload['expiration_date_from'] = $expirationDateFrom;

        return $this;
    }

    public function setExpirationDateTo(string $expirationDateTo): self
    {
        $this->payload['expiration_date_to'] = $expirationDateTo;

        return $this;
    }

    public function setExpires(bool $expires): self
    {
        $this->payload['expires'] = $expires;

        return $this;
    }

    public function setDifferentialPricingId(int $differentialPricingId): self
    {
        $this->payload['differential_pricing'] = ['id' => $differentialPricingId];

        return $this;
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return $this->payload;
    }
}
