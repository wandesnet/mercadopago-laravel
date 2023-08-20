<?php

namespace WandesCardoso\MercadoPago\Resource;

use WandesCardoso\MercadoPago\DTO\Preference;

final class PreferenceResource extends MpResource
{
    protected string $baseUri = '/checkout/preferences';

    /**
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function search(array $params): array
    {
        return $this->get("{$this->baseUri}/search", $params);
    }

    /** @return array<string, mixed> */
    public function find(string $id): array
    {
        return $this->get("{$this->baseUri}/{$id}");
    }

    /**
     * @param Preference $preference
     * @return array<string, mixed>
     */
    public function create(Preference $preference): array
    {
        return $this->post($this->baseUri, $preference->toArray());
    }

    /**
     * @param Preference $preference
     * @return array<string, mixed>
     */
    public function update(Preference $preference, string $id): array
    {
        return $this->put("{$this->baseUri}/{$id}", $preference->toArray());
    }
}
