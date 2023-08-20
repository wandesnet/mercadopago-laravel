<?php

use WandesCardoso\MercadoPago\DTO\Address;
use WandesCardoso\MercadoPago\DTO\Identification;
use WandesCardoso\MercadoPago\DTO\Item;
use WandesCardoso\MercadoPago\DTO\Payer;
use WandesCardoso\MercadoPago\DTO\Payment;
use WandesCardoso\MercadoPago\DTO\Phone;

it('can create DTO payment with single items', function () {

    $item = Item::make()
        ->setTitle('Teste produto 1')
        ->setQuantity(1)
        ->setUnitPrice(100)
        ->setDescription('Teste de descrição do produto')
        ->setPictureUrl('https://www.mercadopago.com/org-img/MP3/home/logomp3.gif')
        ->setCategoryId('electronics');

    $payment = Payment::make()
        ->addItem($item)
        ->toArray();

    expect($payment)->toBeArray()
        ->and($payment['additional_info']['items'])->toBeArray()
        ->and($payment['additional_info']['items'])->toHaveCount(1)
        ->and($payment['transaction_amount'])->toEqual(100);
});

it('can create DTO payment with multiples items', function () {

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
        ->addItem($item)
        ->toArray();

    expect($payment)->toBeArray()
        ->and($payment['additional_info']['items'])->toBeArray()
        ->and($payment['additional_info']['items'])->toHaveCount(2)
        ->and($payment['transaction_amount'])->toEqual(150);
});

it('can set payer in payment DTO', function () {
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
        new Identification(
            'CPF',
            '19119119100'
        )
    );

    $payment = Payment::make()
        ->setPayer($payer)
        ->toArray();

    expect($payment)->toBeArray()
        ->and($payment['additional_info']['payer'])->toBeArray()
        ->and($payment['additional_info']['payer']['first_name'])->toEqual('Wandes')
        ->and($payment['additional_info']['payer']['last_name'])->toEqual('Cardoso')
        ->and($payment['additional_info']['payer']['phone']['area_code'])->toEqual('11')
        ->and($payment['additional_info']['payer']['phone']['number'])->toEqual('999999999')
        ->and($payment['additional_info']['shipments']['receiver_address']['zip_code'])->toEqual('12312-123')
        ->and($payment['additional_info']['shipments']['receiver_address']['street_name'])->toEqual('Av das Nacoes Unidas')
        ->and($payment['additional_info']['shipments']['receiver_address']['street_number'])->toBeInt()
        ->and($payment['additional_info']['shipments']['receiver_address']['street_number'])->toEqual(3003)
        ->and($payment['additional_info']['shipments']['receiver_address']['floor'])->toEqual('1')
        ->and($payment['additional_info']['shipments']['receiver_address']['apartment'])->toEqual('12')
        ->and($payment['additional_info']['shipments']['receiver_address']['city_name'])->toEqual('Buzios')
        ->and($payment['additional_info']['shipments']['receiver_address']['state_name'])->toEqual('Rio de Janeiro')
        ->and($payment['payer']['first_name'])->toEqual('Wandes')
        ->and($payment['payer']['last_name'])->toEqual('Cardoso')
        ->and($payment['payer']['email'])->toEqual('test_user_715128095@testuser.com')
        ->and($payment['payer']['entity_type'])->toEqual('individual')
        ->and($payment['payer']['type'])->toEqual('customer')
        ->and($payment['payer']['identification']['type'])->toEqual('CPF')
        ->and($payment['payer']['identification']['number'])->toEqual('19119119100');

});
