<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Contracts\Arrayable;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class Address implements Arrayable
{
    use Makeable;

    public function __construct(
        public ?string $zip_code = null,
        public ?string $state_name = null,
        public ?string $city_name = null,
        public ?string $street_name = null,
        public ?int $street_number = null,
        public ?string $floor = null,
        public ?string $apartment = null,
    ) {
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'zip_code' => $this->zip_code,
            'state_name' => $this->state_name,
            'city_name' => $this->city_name,
            'street_name' => $this->street_name,
            'street_number' => $this->street_number,
            'floor' => $this->floor,
            'apartment' => $this->apartment,
        ];
    }

    /**
     * @param  string|null  $zip_code
     *
     * @return Address
     */
    public function setZipCode(?string $zip_code): self
    {
        $this->zip_code = $zip_code;

        return $this;
    }

    /**
     * @param  string|null  $state_name
     *
     * @return Address
     */
    public function setStateName(?string $state_name): self
    {
        $this->state_name = $state_name;

        return $this;
    }

    /**
     * @param  string|null  $city_name
     *
     * @return Address
     */
    public function setCityName(?string $city_name): self
    {
        $this->city_name = $city_name;

        return $this;
    }

    /**
     * @param  string|null  $street_name
     *
     * @return Address
     */
    public function setStreetName(?string $street_name): self
    {
        $this->street_name = $street_name;

        return $this;
    }

    /**
     * @param  int|null  $street_number
     *
     * @return Address
     */
    public function setStreetNumber(?int $street_number): self
    {
        $this->street_number = $street_number;

        return $this;
    }

    /**
     * @param  string|null  $floor
     *
     * @return Address
     */
    public function setFloor(?string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * @param  string|null  $apartment
     *
     * @return Address
     */
    public function setApartment(?string $apartment): self
    {
        $this->apartment = $apartment;

        return $this;
    }
}
