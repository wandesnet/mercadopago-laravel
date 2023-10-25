<?php

use Saloon\Http\Request;
use Saloon\Http\Response;
use WandesCardoso\MercadoPago\MercadoPago as Mp;
use WandesCardoso\MercadoPago\Request\DeleteRequest;

it('can request delete', function () {
    $mockClient = mockClient(['id' => 123456789]);

    $response = Mp::make(getAccessToken())->send(new DeleteRequest('payments/123456789'), $mockClient);

    $mockClient->assertSent(DeleteRequest::class);

    $mockClient->assertSent('payments/123456789');

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->getMethod()->name === 'DELETE';
    });

    expect($response->object()->id)->toEqual(123456789)
        ->and($response->status())->toEqual(200);
});
