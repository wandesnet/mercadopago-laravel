<?php

namespace WandesCardoso\MercadoPago\DTO;

use WandesCardoso\MercadoPago\Contracts\Arrayable;
use WandesCardoso\MercadoPago\Traits\Makeable;

final class BackUrls implements Arrayable
{
    use Makeable;

    public function __construct(private readonly ?string $success = null, private readonly ?string $pending = null, private readonly ?string $failure = null)
    {

    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'pending' => $this->pending,
            'failure' => $this->failure,
        ];
    }
}
