<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Contracts\Arrayable;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class Identification implements Arrayable
{
    use Makeable;

    public function __construct(public ?string $type = null, public ?string $number = null)
    {

    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'number' => $this->number,
        ];
    }

    /**
     * @param  string|null  $type
     *
     * @return Identification
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param  string|null  $number
     *
     * @return Identification
     */
    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }
}
