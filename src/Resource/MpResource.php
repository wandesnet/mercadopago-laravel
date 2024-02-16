<?php

declare(strict_types=1);

namespace WandesCardoso\MercadoPago\Resource;

use WandesCardoso\MercadoPago\Request\GetRequest;
use WandesCardoso\MercadoPago\Request\PutRequest;
use WandesCardoso\MercadoPago\Request\PostRequest;
use WandesCardoso\MercadoPago\Request\DeleteRequest;

class MpResource extends Resource
{
    public function withHeader(string $name, string $value): static
    {
        $this->connector->headers()->add($name, $value);

        return $this;
    }

    /**
     * @param  array<string, mixed>  $params
     *
     * @return array <string, mixed>
     * */
    public function get(string $uri, array $params = []): array
    {
        $response = $this->connector->send(new GetRequest($uri, $params));

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /**
     * @param array<string, mixed> $data
     * @return array <string, mixed>
     * */
    public function post(string $uri, array $data): array
    {
        $response = $this->connector->send(new PostRequest($uri, $data));

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /**
     * @param array<string, mixed> $data
     * @return array <string, mixed>
     * */
    public function put(string $uri, array $data): array
    {
        $response = $this->connector->send(new PutRequest($uri, $data));

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }

    /** @return array <string, mixed> */
    public function delete(string $uri): array
    {
        $response = $this->connector->send(new DeleteRequest($uri));

        return [
            'body' => json_decode($response->body()),
            'httpCode' => $response->status(),
        ];
    }
}
