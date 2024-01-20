<?php

use WandesCardoso\MercadoPago\Facades\MercadoPago as FacadesMercadoPago;
use WandesCardoso\MercadoPago\MercadoPago;

function mercadoPago(?string $access_token = null): MercadoPago
{
    return FacadesMercadoPago::make(access_token: $access_token);
}
