<?php

namespace WandesCardoso\MercadoPago\Contracts;

use WandesCardoso\MercadoPago\DTO\Item;
use WandesCardoso\MercadoPago\DTO\Payer;

interface PaymentDto
{
    /** @return array<string, mixed> */
    public function toArray(): array;

    /** @param  array<Item>|Item $item */
    public function addItem(array|Item $item): self;

    public function setPayer(Payer $payer): self;
}
