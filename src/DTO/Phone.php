<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Contracts\Arrayable;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class Phone implements Arrayable
{
    use Makeable;

    public function __construct(public ?string $areaCode = null, public ?string $number = null)
    {

    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'area_code' => $this->areaCode,
            'number' => $this->number,
        ];
    }

    /**
     * @param  string|null  $areaCode
     *
     * @return Phone
     */
    public function setAreaCode(?string $areaCode): self
    {
        $this->areaCode = $areaCode;

        return $this;
    }

    /**
     * @param  string|null  $number
     *
     * @return Phone
     */
    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }
}
