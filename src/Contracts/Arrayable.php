<?php

namespace WandesCardoso\MercadoPago\Contracts;

interface Arrayable
{
    /**
     * Get the instance as an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
