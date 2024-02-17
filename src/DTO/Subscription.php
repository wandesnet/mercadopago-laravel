<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Contracts\Arrayable;
use WandesCardoso\MercadoPago\Enums\Currency;
use WandesCardoso\MercadoPago\Enums\FrequencyType;
use WandesCardoso\MercadoPago\Enums\Status;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class Subscription implements Arrayable
{
    use Makeable;

    /** @var array{auto_recurring: array{frequency?: int, frequency_type?: string, start_date?: string, end_date?: string, transaction_amount?: float, currency_id?: string}, back_url: string, card_token_id: string, external_reference: string, payer_email: string, preapproval_plan_id: string, reason: string, status: string} */
    private array $payload;

    public function __construct()
    {

    }

    public function setAutoRecurring(?int $frequency = null, ?FrequencyType $frequencyType = null, ?string $startDate = null, ?string $endDate = null, ?float $amount = null, ?Currency $currency = null): self
    {
        $this->payload['auto_recurring'] = array_filter([
            'frequency' => $frequency,
            'frequency_type' => $frequencyType?->value,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'transaction_amount' => $amount,
            'currency_id' => $currency?->value,
        ]);

        return $this;
    }

    public function setBackUrl(string $backUrl): self
    {
        $this->payload['back_url'] = $backUrl;

        return $this;
    }

    public function setReason(string $reason): self
    {
        $this->payload['reason'] = $reason;

        return $this;
    }

    public function setCredCardTokenId(string $cardTokenId): self
    {
        $this->payload['card_token_id'] = $cardTokenId;

        return $this;
    }

    public function setExternalReference(string $externalReference): self
    {
        $this->payload['external_reference'] = $externalReference;

        return $this;
    }

    public function setPayerEmail(string $payerEmail): self
    {
        $this->payload['payer_email'] = $payerEmail;

        return $this;
    }

    public function setPreapprovalPlanId(string $preapprovalPlanId): self
    {
        $this->payload['preapproval_plan_id'] = $preapprovalPlanId;

        return $this;
    }

    public function setStatus(Status $status): self
    {
        $this->payload['status'] = $status->value;

        return $this;
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return $this->payload;
    }
}
