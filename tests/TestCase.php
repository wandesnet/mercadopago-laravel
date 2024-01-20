<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use WandesCardoso\MercadoPago\MercadoPagoServiceProvider;
use WandesCardoso\MercadoPago\Facades\MercadoPago;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            MercadoPagoServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'MercadoPago' => MercadoPago::class,
        ];
    }
}
