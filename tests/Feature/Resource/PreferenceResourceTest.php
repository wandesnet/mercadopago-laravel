<?php

use WandesCardoso\MercadoPago\DTO\Address;
use WandesCardoso\MercadoPago\DTO\Item;
use WandesCardoso\MercadoPago\DTO\Payer;
use WandesCardoso\MercadoPago\DTO\Phone;
use WandesCardoso\MercadoPago\DTO\Preference;
use WandesCardoso\MercadoPago\MercadoPago as Mp;

it('can create preference multiples with items', function () {

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

    $preference = Preference::make()
        ->setPayer($payer)
        ->addItem($item)
        ->setExternalReference('55');

    $mockClient = mockClient([
        'id' => '1453102599-aa64bcbb-82d9-4dff-8099-6b49c0f95406',
        'init_point' => 'https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=1453102599-aa64bcbb-82d9-4dff-8099-6b49c0f95406',
    ]);

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->preference()->create($preference);

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('1453102599-aa64bcbb-82d9-4dff-8099-6b49c0f95406')
        ->and($response['body']->init_point)->toEqual('https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=1453102599-aa64bcbb-82d9-4dff-8099-6b49c0f95406')
        ->and($response['httpCode'])->toEqual(200);
});

it('can get preference', function () {
    $mockClient = mockClient([
        'id' => 1234567890,
    ]);

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->preference()->find('1234567890');

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('1234567890')
        ->and($response['httpCode'])->toEqual(200);
});

it('can search preference', function () {
    $mockClient = mockClient([
        'elements' => [
            [
                'id' => 1234567890,
                'external_reference' => '20',
                'items' => [],
            ],
        ],
    ]);

    $params = [
        'external_reference' => '20',
    ];

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->preference()->search($params);

    expect($response)->toBeArray()
        ->and($response['body']->elements[0]->id)->toEqual(1234567890)
        ->and($response['body']->elements[0]->external_reference)->toEqual('20')
        ->and($response['body']->elements[0]->items)->toBeArray()
        ->and($response['httpCode'])->toEqual(200);
});

it('can update a preference', function () {
    $payer = new Payer(
        'test_user_joe5@testuser.com',
        'Joe',
        'Doe',
    );

    $item = Item::make()
        ->setTitle('Teste produto 1')
        ->setQuantity(1)
        ->setUnitPrice(100)
        ->setDescription('Teste de descrição do produto')
        ->setPictureUrl('https://www.mercadopago.com/org-img/MP3/home/logomp3.gif')
        ->setCategoryId('electronics');

    $preference = Preference::make()
        ->setPayer($payer)
        ->addItem($item)
        ->setExternalReference('55');

    $mockClient = mockClient([
        'id' => '1453102599-aa64bcbb-82d9-4dff-8099-6b49c0f95406',
        'init_point' => 'https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=1453102599-aa64bcbb-82d9-4dff-8099-6b49c0f95406',
    ]);

    $response = Mp::make(getAccessToken())->withMockClient($mockClient)->preference()->update($preference, '1453102599-aa64bcbb-82d9-4dff-8099-6b49c0f95406');

    expect($response)->toBeArray()
        ->and($response['body']->id)->toEqual('1453102599-aa64bcbb-82d9-4dff-8099-6b49c0f95406')
        ->and($response['body']->init_point)->toEqual('https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=1453102599-aa64bcbb-82d9-4dff-8099-6b49c0f95406')
        ->and($response['httpCode'])->toEqual(200);
});
