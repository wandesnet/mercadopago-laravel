<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Contracts\Arrayable;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class PaymentMethods implements Arrayable
{
    use Makeable;

    /**
     * @param  array<string, mixed> $excludedPaymentMethods
     * @param  array<string, mixed> $excludedPaymentTypes
     */
    public function __construct(
        private readonly array $excludedPaymentMethods = [],
        private readonly array $excludedPaymentTypes = [],
        private readonly ?string $defaultPaymentMethodId = null,
        private readonly ?int $installments = null,
        private readonly ?int $defaultInstallments = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'excluded_payment_methods' => $this->excludedPaymentMethods,
            'excluded_payment_types' => $this->excludedPaymentTypes,
            'default_payment_method_id' => $this->defaultPaymentMethodId,
            'installments' => $this->installments,
            'default_installments' => $this->defaultInstallments,
        ];
    }
}
