<?php

use Saloon\Http\Request;
use Saloon\Http\Response;
use WandesCardoso\MercadoPago\MercadoPago as Mp;
use WandesCardoso\MercadoPago\Request\PostRequest;

it('can send post', function () {
    $mockClient = mockClient(['id' => 123456789]);

    $response = Mp::make(getAccessToken())->send(new PostRequest('payments', [
        'id' => 123456789,
        'title' => 'Test product',
        'description' => 'Product description',
        'category_id' => 'MLB1234',
    ]), $mockClient);

    $mockClient->assertSent(PostRequest::class);

    $mockClient->assertSent('payments');

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->getMethod()->name === 'POST';
    });

    expect($response->object()->id)->toEqual(123456789)
        ->and($response->status())->toEqual(200);
});
