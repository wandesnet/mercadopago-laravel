<?php

use Saloon\Http\Request;
use Saloon\Http\Response;
use WandesCardoso\MercadoPago\MercadoPago as Mp;
use WandesCardoso\MercadoPago\Request\GetRequest;

it('can request get', function ($id) {
    $mockClient = mockClient(['id' => $id]);

    $response = Mp::make(getAccessToken())->send(new GetRequest("payments/{$id}", []), $mockClient);

    $mockClient->assertSent(GetRequest::class);

    $mockClient->assertSent("/payments/{$id}");

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request->getMethod()->name === 'GET';
    });

    expect($response->object()->id)->toEqual($id)
        ->and($response->status())->toEqual(200);
})->with(['57594166248']);
