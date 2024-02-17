<?php

namespace WandesCardoso\MercadoPago\Resource;

use WandesCardoso\MercadoPago\DTO\Subscription;
use WandesCardoso\MercadoPago\Enums\Status;

final class SubscriptionResource extends MpResource
{
    protected string $baseUri = 'preapproval';

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
     * @param Subscription $subscription
     * @return array<string, mixed>
     */
    public function create(Subscription $subscription): array
    {
        return $this->post($this->baseUri, $subscription->toArray());
    }

    /**
     * @param Subscription $subscription
     * @return array<string, mixed>
     */
    public function update(Subscription $subscription, string $id): array
    {
        return $this->put("/{$this->baseUri}/{$id}", $subscription->toArray());
    }

    /**
     * @param array<Status> $status
     * @return array<string, mixed>
     */
    public function export(string $collectorId, string $preapprovalPlanId = '', array $status = [], string $sort = ''): array
    {
        return $this->get("/{$this->baseUri}/export", [
            'collector_id' => $collectorId,
            'preapproval_plan_id' => $preapprovalPlanId,
            'status' => implode(',', array_map(fn (Status $status) => $status->value, $status)),
            'sort' => $sort,
        ]);
    }
}
