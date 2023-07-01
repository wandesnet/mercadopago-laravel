<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoPago\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetPaymentRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected string $id)
    {
    }

    public function resolveEndpoint(): string
    {
        return "/payments/{$this->id}";
    }
}
