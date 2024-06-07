<?php

use WandesCardoso\MercadoPago\MercadoPago as Mp;

it('can get a invoice with authorized payment', function () {
    $mockClient = mockClient('invoice/find');

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->invoice()->find(1234567890);

    expect($response)->toBeArray()
        ->and($response['httpCode'])->toEqual(200)
        ->and($response['body']->id)->toBe(1234567890)
        ->and($response['body']->status)->toBe('processed')
        ->and($response['body']->payment->id)->toBe(1234567890)
        ->and($response['body']->payment->status)->toBe('approved');
});

it('can search a invoice with authorized payment', function () {
    $mockClient = mockClient('invoice/search');

    $params = [
        'preapproval_id' => '1234567890',
    ];

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->invoice()->search($params);

    expect($response)->toBeArray()
        ->and($response['httpCode'])->toEqual(200)
        ->and($response['body']->results)->toBeArray()->toHaveLength(1)
        ->and($response['body']->results[0]->id)->toBe(1234567890)
        ->and($response['body']->results[0]->status)->toBe('processed')
        ->and($response['body']->results[0]->payment->id)->toBe(1234567890)
        ->and($response['body']->results[0]->payment->status)->toBe('approved');
});
