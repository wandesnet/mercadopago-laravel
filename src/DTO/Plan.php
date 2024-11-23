<?php

namespace WandesCardoso\MercadoPago\DTO;

use Exception;
use WandesCardoso\MercadoPago\Contracts\Arrayable;
use WandesCardoso\MercadoPago\Enums\Currency;
use WandesCardoso\MercadoPago\Enums\FrequencyType;
use WandesCardoso\MercadoPago\Enums\PaymentType;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class Plan implements Arrayable
{
    use Makeable;

    /** @var array{auto_recurring: array{frequency: int, frequency_type: string, repetitions: int, billing_day: int, billing_day_proportional: bool, free_trial: array{frequency: int, frequency_type: string}, transaction_amount: float, currency_id: string}, back_url: string, reason: string, payment_methods_allowed: array{payment_types: array<int, array{id: string}>, payment_methods: array<int, array{id: string}>}} */
    private array $payload;

    public function __construct()
    {

    }

    public function setFrequency(int $frequency): self
    {
        $this->payload['auto_recurring']['frequency'] = $frequency;

        return $this;
    }

    public function setFrequencyType(FrequencyType $type): self
    {
        $this->payload['auto_recurring']['frequency_type'] = $type->value;

        return $this;
    }

    public function setRepetitions(int $repetitions): self
    {
        $this->payload['auto_recurring']['repetitions'] = $repetitions;

        return $this;
    }

    public function setBillingDay(int $billing_day): self
    {
        $this->payload['auto_recurring']['billing_day'] = $billing_day;

        return $this;
    }

    public function setBillingDayProportional(bool $billingDayProportional): self
    {
        $this->payload['auto_recurring']['billing_day_proportional'] = $billingDayProportional;

        return $this;
    }

    public function setFreeTrial(int $frequency, FrequencyType $type): self
    {
        $this->payload['auto_recurring']['free_trial'] = [
            'frequency' => $frequency,
            'frequency_type' => $type->value,
        ];

        return $this;
    }

    public function setTransactionAmount(float $amount): self
    {
        $this->payload['auto_recurring']['transaction_amount'] = $amount;

        return $this;
    }

    public function setCurrencyId(Currency $currency): self
    {
        $this->payload['auto_recurring']['currency_id'] = $currency->value;

        return $this;
    }

    public function setBackUrl(string $back_url): self
    {
        $this->payload['back_url'] = $back_url;

        return $this;
    }

    public function setReason(string $reason): self
    {
        $this->payload['reason'] = $reason;

        return $this;
    }

    /**
     * @param  array<PaymentType> | PaymentType  $paymentTypes
     *
     * @return array<int, array{id: string}>
     * @throws Exception
     */
    private function setPaymentType(array|PaymentType $paymentTypes): array
    {
        $types = [];

        if ( ! is_array($paymentTypes)) {
            $paymentTypes = [$paymentTypes];
        }

        foreach ($paymentTypes as $type) {

            if ( ! $type instanceof PaymentType) {
                throw new \InvalidArgumentException('Payment type must be an instance of PaymentType');
            }

            $types[] = ['id' => $type->value];
        }

        return $types;
    }

    /**
     * @param array<string> $paymentMethods
     *
     * @return array<int, array{id: string}>
     */
    private function setPaymentMethods(array $paymentMethods): array
    {
        $methods = [];

        foreach ($paymentMethods as $method) {
            $methods[] = ['id' => $method];
        }

        return $methods;
    }

    /**
     * @param  array<PaymentType> | PaymentType  $paymentTypes
     * @param  array<string>  $paymentMethods
     *
     * @throws Exception
     */
    public function setPaymentMethodsAllowed(array|PaymentType $paymentTypes, array $paymentMethods = []): self
    {
        $this->payload['payment_methods_allowed']['payment_types'] = $this->setPaymentType($paymentTypes);
        $this->payload['payment_methods_allowed']['payment_methods'] = $this->setPaymentMethods($paymentMethods);

        return $this;
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return $this->payload;
    }
}
