<?php

namespace WandesCardoso\MercadoPago\Resource;

use WandesCardoso\MercadoPago\DTO\Plan;

final class PlanResource extends MpResource
{
    protected string $baseUri = 'preapproval_plan';

    /**
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     */
    public function search(array $params): array
    {
        return $this->get("/{$this->baseUri}/search", $params);
    }

    /** @return array<string, mixed> */
    public function find(string $id): array
    {
        return $this->get("/{$this->baseUri}/{$id}");
    }

    /**
     * @param Plan $plan
     * @return array<string, mixed>
     */
    public function create(Plan $plan): array
    {
        return $this->post($this->baseUri, $plan->toArray());
    }

    /**
     * @param Plan $plan
     * @return array<string, mixed>
     */
    public function update(Plan $plan, string $id): array
    {
        return $this->put("/{$this->baseUri}/{$id}", $plan->toArray());
    }
}
