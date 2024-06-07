<?php

namespace WandesCardoso\MercadoPago\Resource;

final class InvoiceResource extends MpResource
{
    protected string $baseUri = '/authorized_payments';

    /**
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function search(array $params): array
    {
        return $this->get("/{$this->baseUri}/search", $params);
    }

    /** @return array<string, mixed> */
    public function find(int $id): array
    {
        return $this->get("/{$this->baseUri}/{$id}");
    }
}
