<?php

use WandesCardoso\MercadoPago\DTO\Address;
use WandesCardoso\MercadoPago\DTO\Item;
use WandesCardoso\MercadoPago\DTO\Payer;
use WandesCardoso\MercadoPago\DTO\Payment;
use WandesCardoso\MercadoPago\DTO\PaymentUpdate;
use WandesCardoso\MercadoPago\DTO\Phone;
use WandesCardoso\MercadoPago\Enums\Status;
use WandesCardoso\MercadoPago\MercadoPago as Mp;

it('can create payment multiples items', function () {

    $payer = new Payer(
        'test_user_715128095@testuser.com',
        'Wandes',
        'Cardoso',
        new Address(
            '12312-123',
            'Rio de Janeiro',
            'Buzios',
            'Av das Nacoes Unidas',
            3003,
            '1',
            '12'
        ),
        new Phone(
            '11',
            '999999999'
        ),
    );

    $item = [
        Item::make()
            ->setTitle('Teste produto 1')
            ->setQuantity(1)
            ->setUnitPrice(100)
            ->setDescription('Teste de descrição do produto')
            ->setPictureUrl('https://www.mercadopago.com/org-img/MP3/home/logomp3.gif')
            ->setCategoryId('electronics'),
        Item::make()
            ->setTitle('Teste produto 2')
            ->setQuantity(1)
            ->setUnitPrice(50)
            ->setDescription('Teste de descrição do produto')
            ->setPictureUrl('https://www.mercadopago.com/org-img/MP3/home/logomp3.gif')
            ->setCategoryId('electronics'),
    ];

    $payment = Payment::make()
        ->setPayer($payer)
        ->addItem($item)
        ->setPaymentMethodId('pix')
        ->setExternalReference('55');

    $mockClient = mockClient(
        mock: [
            'id' => 123456,
            'transaction_amount' => 150,
            'status' => 'approved',
        ],
        status: 201
    );

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->payment()->create($payment);

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual(123456)
        ->and($response['body']->transaction_amount)->toEqual(150)
        ->and($response['body']->status)->toEqual('approved')
        ->and($response['httpCode'])->toEqual(201);
});

it('can get payment', function () {
    $mockClient = mockClient([
        'id' => 1234567890,
        'status' => 'approved',
        'transaction_amount' => 100,
    ]);

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->payment()->find('1234567890');

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('1234567890')
        ->and($response['body']->status)->toEqual('approved')
        ->and($response['body']->transaction_amount)->toEqual(100)
        ->and($response['httpCode'])->toEqual(200);
});

it('can search payment', function () {
    $mockClient = mockClient([
        'id' => 1234567890,
        'status' => 'approved',
        'transaction_amount' => 100,
    ]);

    $params = [
        'sort' => 'date_created',
        'criteria' => 'desc',
        'external_reference' => 'ID_REF',
        'range' => 'date_created',
        'begin_date' => 'NOW-30DAYS',
        'end_date' => 'NOW',
    ];

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->payment()->search($params);

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('1234567890')
        ->and($response['body']->status)->toEqual('approved')
        ->and($response['body']->transaction_amount)->toEqual(100)
        ->and($response['httpCode'])->toEqual(200);
});

it('can update a payment', function () {
    $mockClient = mockClient([
        'id' => 1234567890,
        'status' => Status::approved,
        'transaction_amount' => 100,
    ]);

    $payment = PaymentUpdate::make()
        ->setTransactionAmount(100)
        ->setCapture(true)
        ->setStatus(Status::approved)
        ->setDateOfExpiration('2021-12-01T00:00:00.000-04:00');

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->payment()->update($payment, 1234567890);

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('1234567890')
        ->and($response['body']->status)->toEqual(Status::approved->value)
        ->and($response['body']->transaction_amount)->toEqual(100)
        ->and($response['httpCode'])->toEqual(200);
});
