<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoPago\Request;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetRequest extends Request
{
    protected Method $method = Method::GET;

    /** @param array<string, mixed> $params */
    public function __construct(protected string $uri, protected array $params)
    {
    }

    public function resolveEndpoint(): string
    {
        return $this->uri;
    }

    protected function defaultQuery(): array
    {
        return $this->params;
    }
}
