<?php

namespace WandesCardoso\MercadoPago\Enums;

enum PaymentType: string
{
    case ACCOUNT_MONEY = 'account_money';
    case TICKET = 'ticket';
    case BANK_TRANSFER = 'bank_transfer';
    case ATM = 'atm';
    case CREDIT_CARD = 'credit_card';
    case DEBIT_CARD = 'debit_card';
    case PREPAID_CARD = 'prepaid_card';
    case DIGITAL_CURRENCY = 'digital_currency';
    case DIGITAL_WALLET = 'digital_wallet';
    case VOUCHER_CARD = 'voucher_card';
    case CRYPTO_TRANSFER = 'crypto_transfer';

}
