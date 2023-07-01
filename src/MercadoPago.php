<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoPago;

use Saloon\Http\Connector;
use WandesCardoso\MercadoPago\Traits\MpRequestTrait;

final class MercadoPago extends Connector
{
    use MpRequestTrait;

    public function __construct(?string $access_token = null)
    {
        $this->withTokenAuth($access_token ?? config('mercadopago.access_token'));
    }

    public function resolveBaseUrl(): string
    {
        return 'https://api.mercadopago.com/v1';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
}
