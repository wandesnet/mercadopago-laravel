<?php

use WandesCardoso\MercadoPago\MercadoPago as Mp;

it('can get', function () {
    $mockClient = mockClient([
        'id' => 1234567889,
    ]);

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->request()->get('payments/1234567889');

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual(1234567889)
        ->and($response['httpCode'])->toEqual(200);
});

it('can post', function () {
    $mockClient = mockClient([
        'user_id' => 123456,
    ]);

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->request()->post('payments', [
        'user_id' => 123456,
    ]);

    expect($response)->toBeArray()
        ->and($response['body']->user_id)->toEqual(123456)
        ->and($response['httpCode'])->toEqual(200);
});

it('can delete', function () {
    $mockClient = mockClient([
        'user_id' => 3123456,
    ]);

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->request()->delete('payments/3123456');

    expect($response)->toBeArray()
        ->and($response['body']->user_id)->toEqual(3123456)
        ->and($response['httpCode'])->toEqual(200);
});
