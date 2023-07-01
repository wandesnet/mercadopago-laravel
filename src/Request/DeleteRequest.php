<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoPago\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(protected string $uri)
    {
    }

    public function resolveEndpoint(): string
    {
        return $this->uri;
    }
}
