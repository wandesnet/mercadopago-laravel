<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Contracts\Arrayable;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class Payer implements Arrayable
{
    use Makeable;

    /**
     * @param  array<string, mixed>|Address  $address
     * @param  array<string, mixed>|Phone  $phone
     * @param  array<string, mixed>|Identification  $identification
     */
    public function __construct(
        public ?string $email = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public array|Address $address = [],
        public array|Phone $phone = [],
        public array|Identification $identification = [],
        public string $entityType = 'individual',
        public string $type = 'customer',
        public ?string $id = null,
    ) {
    }

    /** @return array<string, mixed> */
    protected function getAdditionalInfoPayer(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'phone' => $this->getPhone(),
        ];
    }

    /** @return array<string, mixed> */
    protected function payer(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'entity_type' => $this->entityType,
            'type' => $this->type,
            'id' => $this->id,
            'identification' => $this->getIdentification()->toArray(),
        ];
    }

    /** @return array<string, mixed> */
    protected function payerPreference(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->getPhone(),
            'identification' => $this->getIdentification()->toArray(),
            'address' => $this->getAddress()->toArray(),
        ];
    }

    /** @return array<string, mixed> */
    protected function getPhone(): array
    {
        return $this->phone instanceof Phone ? $this->phone->toArray() : $this->phone;
    }

    protected function getIdentification(): Identification
    {
        return $this->identification instanceof Identification ? $this->identification : Identification::make($this->identification);
    }

    public function getAddress(): Address
    {
        return $this->address instanceof Address ? $this->address : Address::make($this->address);
    }

    public function toArray(): array
    {
        return [
            'payer' => $this->payer(),
            'additional_info' => $this->getAdditionalInfoPayer(),
            'address' => $this->getAddress()->toArray(),
            'preferences' => $this->payerPreference(),
        ];
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /** @param  Address|array<string, mixed>  $address */
    public function setAddress(Address|array $address): self
    {
        $this->address = $address;

        return $this;
    }

    /** @param  Phone|array<string, mixed>  $phone */
    public function setPhone(Phone|array $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /** @param  Identification|array<string, mixed>  $identification */
    public function setIdentification(Identification|array $identification): self
    {
        $this->identification = $identification;

        return $this;
    }

    public function setEntityType(string $entityType): self
    {
        $this->entityType = $entityType;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }
}
