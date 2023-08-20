<?php

namespace WandesCardoso\MercadoPago\Enums;

enum Status: string
{
    case approved = 'approved';
    case pending = 'pending';
    case in_process = 'in_process';
    case authorized = 'authorized';
    case rejected = 'rejected';
    case cancelled = 'cancelled';
    case refunded = 'refunded';
    case charged_back = 'charged_back';
}
