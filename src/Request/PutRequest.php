<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoPago\Request;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class PutRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /** @param array<string, mixed> $data */
    public function __construct(protected string $uri, protected array $data)
    {
    }

    public function resolveEndpoint(): string
    {
        return $this->uri;
    }

    /** @return array<string, mixed> */
    protected function defaultBody(): array
    {
        return $this->data;
    }
}
