<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoPago;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use WandesCardoso\MercadoPago\Traits\MpRequest;

final class MercadoPago extends Connector
{
    use MpRequest;

    public function __construct(?string $access_token = null)
    {
        $this->authenticate(new TokenAuthenticator($access_token ?? config('mercadopago.access_token'))); // @phpstan-ignore-line
    }

    public function resolveBaseUrl(): string
    {
        return 'https://api.mercadopago.com';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
