<?php

use WandesCardoso\MercadoPago\DTO\Plan;
use WandesCardoso\MercadoPago\Enums\Currency;
use WandesCardoso\MercadoPago\Enums\FrequencyType;
use WandesCardoso\MercadoPago\Enums\PaymentType;
use WandesCardoso\MercadoPago\Facades\MercadoPago as Mp;

it('can create plan', function () {

    $plan = Plan::make()
        ->setFrequency(1)
        ->setFrequencyType(FrequencyType::MONTHS)
        ->setRepetitions(12)
        ->setBillingDay(15)
        ->setBillingDayProportional(true)
        ->setFreeTrial(30, FrequencyType::DAYS)
        ->setTransactionAmount(100)
        ->setCurrencyId(Currency::BRL)
        ->setReason('Teste de plano')
        ->setBackUrl('https://mysite.com.br/backurl')
        ->setPaymentMethodsAllowed([PaymentType::CREDIT_CARD, PaymentType::DEBIT_CARD]);

    $mockClient = mockClient([
        'id' => '2c9380848d22f7cc018d2725402d01f8',
        'init_point' => 'https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380848d22f7cc018d2725402d01f8',
        'back_url' => 'https://mysite.com.br/backurl',
        'status' => 'active',
        'auto_recurring' => [
            'frequency' => 1,
            'frequency_type' => 'months',
            'transaction_amount' => 100,
            'currency_id' => 'BRL',
            'repetitions' => 12,
        ],
    ], 201);

    $response = mercadoPago()->withMockClient($mockClient)->plan()->create($plan);

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('2c9380848d22f7cc018d2725402d01f8')
        ->and($response['body']->init_point)->toEqual('https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380848d22f7cc018d2725402d01f8')
        ->and($response['httpCode'])->toEqual(201)
        ->and($response['body']->back_url)->toEqual('https://mysite.com.br/backurl')
        ->and($response['body']->status)->toEqual('active')
        ->and($response['body']->auto_recurring->frequency)->toEqual(1)
        ->and($response['body']->auto_recurring->frequency_type)->toEqual('months')
        ->and($response['body']->auto_recurring->transaction_amount)->toEqual(100)
        ->and($response['body']->auto_recurring->currency_id)->toEqual('BRL');
});

it('can get plan', function () {
    $mockClient = mockClient([
        'id' => '2c9380848d22f7cc018d2725402d01f8',
    ]);

    $response = Mp::make()->withMockClient($mockClient)->plan()->find('2c9380848d22f7cc018d2725402d01f8');

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('2c9380848d22f7cc018d2725402d01f8')
        ->and($response['httpCode'])->toEqual(200);
});

it('can search plan', function () {
    $mockClient = mockClient([
        'paging' => [
            'offset' => 0,
            'limit' => 10,
            'total' => 1,
        ],
        'results' => [
            [
                'id' => '2c9380848d22f7cc018d2725402d01f8',
                'init_point' => 'https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380848d22f7cc018d2725402d01f8',
                'auto_recurring' => [
                    'transaction_amount' => 100,
                ],
            ],
        ],
    ]);

    $params = [
        'status' => 'active',
        'q' => '2c9380848d22f7cc018d2725402d01f8',
    ];

    $response = Mp::make()->withMockClient($mockClient)->plan()->search($params);

    expect($response)->toBeArray()
        ->and($response['body']->results[0]->id)->toEqual('2c9380848d22f7cc018d2725402d01f8')
        ->and($response['body']->results[0]->init_point)->toEqual('https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380848d22f7cc018d2725402d01f8')
        ->and($response['body']->results[0]->auto_recurring->transaction_amount)->toEqual(100)
        ->and($response['body']->paging->offset)->toEqual(0)
        ->and($response['body']->paging->limit)->toEqual(10)
        ->and($response['body']->paging->total)->toEqual(1)
        ->and($response['httpCode'])->toEqual(200);
});

it('can update a plan', function () {
    $plan = Plan::make()
        ->setTransactionAmount(50);

    $mockClient = mockClient([
        'id' => '2c9380848d22f7cc018d2725402d01f8',
        'init_point' => 'https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380848d22f7cc018d2725402d01f8',
        'back_url' => 'https://mysite.com.br/backurl',
        'status' => 'active',
        'auto_recurring' => [
            'frequency' => 1,
            'frequency_type' => 'months',
            'transaction_amount' => 50,
            'currency_id' => 'BRL',
            'repetitions' => 12,
        ],
    ]);

    $response = Mp::make()->withMockClient($mockClient)->plan()->update($plan, '2c9380848d22f7cc018d2725402d01f8');

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('2c9380848d22f7cc018d2725402d01f8')
        ->and($response['body']->init_point)->toEqual('https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380848d22f7cc018d2725402d01f8')
        ->and($response['httpCode'])->toEqual(200)
        ->and($response['body']->back_url)->toEqual('https://mysite.com.br/backurl')
        ->and($response['body']->status)->toEqual('active')
        ->and($response['body']->auto_recurring->frequency)->toEqual(1)
        ->and($response['body']->auto_recurring->frequency_type)->toEqual('months')
        ->and($response['body']->auto_recurring->transaction_amount)->toEqual(50)
        ->and($response['body']->auto_recurring->currency_id)->toEqual('BRL');
});
