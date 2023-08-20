<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Contracts\Arrayable;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class Shipments implements Arrayable
{
    use Makeable;

    /** @param  array<string, mixed>  $freeMethods */
    public function __construct(
        private readonly ?string $mode = null,
        private readonly bool $localPickup = false,
        private readonly ?string $dimensions = null,
        private readonly ?int $defaultShippingMethod = null,
        private readonly array $freeMethods = [],
        private readonly ?float $cost = null,
        private readonly bool $freeShipping = false,
        private readonly ?Address $receiverAddress = null
    ) {
    }

    public function toArray(): array
    {
        return [
            'mode' => $this->mode,
            'local_pickup' => $this->localPickup,
            'dimensions' => $this->dimensions,
            'default_shipping_method' => $this->defaultShippingMethod,
            'free_methods' => $this->freeMethods,
            'cost' => $this->cost,
            'free_shipping' => $this->freeShipping,
            'receiver_address' => $this->receiverAddress?->toArray() ?? [],
        ];
    }
}
