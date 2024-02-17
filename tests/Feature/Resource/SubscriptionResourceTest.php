<?php

use WandesCardoso\MercadoPago\DTO\Subscription;
use WandesCardoso\MercadoPago\Enums\Currency;
use WandesCardoso\MercadoPago\Enums\FrequencyType;
use WandesCardoso\MercadoPago\Enums\Status;
use WandesCardoso\MercadoPago\Facades\MercadoPago as Mp;

it('can create subscription', function () {

    $subscription = Subscription::make()
        ->setAutoRecurring(
            frequency: 1,
            frequencyType: FrequencyType::MONTHS,
            startDate: now()->addMonth()->format('Y-m-d\TH:i:s.BP'),
            endDate: now()->addMonths(12)->format('Y-m-d\TH:i:s.BP'),
            amount: 100,
            currency: Currency::BRL,
        )
        ->setPreapprovalPlanId('2c938084726fca480172750000000000')
        ->setCredCardTokenId('2c9380848d22f7cc018d2725402d01f8')
        ->setPayerEmail('test_user_715128095@testuser.com')
        ->setReason('Test de subscription')
        ->setStatus(Status::pending)
        ->setBackUrl('https://mysite.com.br/backurl');

    $mockClient = mockClient('subscription/create', 201);

    $response = mercadoPago()->withMockClient($mockClient)->subscription()->create($subscription);

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('2c938084726fca480172750000000000')
        ->and($response['body']->init_point)->toEqual('https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_id=2c938084726fca480172750000000000')
        ->and($response['httpCode'])->toEqual(201)
        ->and($response['body']->back_url)->toEqual('https://mysite.com.br/backurl')
        ->and($response['body']->status)->toEqual('pending')
        ->and($response['body']->auto_recurring->frequency)->toEqual(1)
        ->and($response['body']->auto_recurring->frequency_type)->toEqual('months')
        ->and($response['body']->auto_recurring->transaction_amount)->toEqual(100)
        ->and($response['body']->auto_recurring->currency_id)->toEqual('BRL');
});

it('can get subscription', function () {
    $mockClient = mockClient([
        'id' => '2c9380848d22f7cc018d2725402d01f8',
    ]);

    $response = Mp::make()->withMockClient($mockClient)->subscription()->find('2c9380848d22f7cc018d2725402d01f8');

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('2c9380848d22f7cc018d2725402d01f8')
        ->and($response['httpCode'])->toEqual(200);
});

it('can search subscription', function () {
    $mockClient = mockClient('subscription/search');

    $params = [
        'status' => 'active',
        'q' => 'plan gold',
        'preapproval_plan_id' => '2c938084726fca480172750000000000',
    ];

    $response = Mp::make()->withMockClient($mockClient)->subscription()->search($params);

    expect($response)->toBeArray()
        ->and($response['body']->results[0]->id)->toEqual('2c938084726fca480172750000000000')
        ->and($response['body']->results[0]->init_point)->toEqual('https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_id=2c938084726fca480172750000000000')
        ->and($response['body']->results[0]->auto_recurring->transaction_amount)->toEqual(100)
        ->and($response['body']->paging->offset)->toEqual(0)
        ->and($response['body']->paging->limit)->toEqual(20)
        ->and($response['body']->paging->total)->toEqual(100)
        ->and($response['httpCode'])->toEqual(200);
});

it('can update a subscription', function () {

    $subscription = Subscription::make()
        ->setAutoRecurring(
            amount: 100,
            currency: Currency::BRL,
        )
        ->setCredCardTokenId('2c9380848d22f7cc018d2725402d01f8')
        ->setReason('Test de subscription')
        ->setStatus(Status::pending)
        ->setBackUrl('https://mysite.com.br/backurl');

    $mockClient = mockClient('subscription/update');

    $response = mercadoPago()->withMockClient($mockClient)->subscription()->update($subscription, '2c938084726fca480172750000000000');

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('2c938084726fca480172750000000000')
        ->and($response['body']->init_point)->toEqual('https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_id=2c938084726fca480172750000000000')
        ->and($response['httpCode'])->toEqual(200)
        ->and($response['body']->back_url)->toEqual('https://mysite.com.br/backurl')
        ->and($response['body']->status)->toEqual('pending')
        ->and($response['body']->auto_recurring->frequency)->toEqual(1)
        ->and($response['body']->auto_recurring->frequency_type)->toEqual('months')
        ->and($response['body']->auto_recurring->transaction_amount)->toEqual(100)
        ->and($response['body']->auto_recurring->currency_id)->toEqual('BRL');
});

it('can export subscription', function () {
    $mockClient = mockClient(mock: [], status: 204);

    $response = Mp::make()->withMockClient($mockClient)->subscription()->export(collectorId: '100200300', status: [Status::pending, Status::approved]);

    expect($response)->toBeArray()
        ->and($response['httpCode'])->toEqual(204);
});
