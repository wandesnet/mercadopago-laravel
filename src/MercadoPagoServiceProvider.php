<?php

namespace WandesCardoso\MercadoPago;

use Illuminate\Support\ServiceProvider;

class MercadoPagoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/mercadopago.php', 'mercadopago');

        $this->app->singleton(MercadoPago::class, function () {
            return new MercadoPago(config('mercadopago.access_token')); // @phpstan-ignore-line
        });

        $this->app->alias(MercadoPago::class, 'mercadopago');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/mercadopago.php' => config_path('mercadopago.php'),
        ], 'config');
    }
}
