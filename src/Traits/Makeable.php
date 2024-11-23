<?php

namespace WandesCardoso\MercadoPago\Traits;

trait Makeable
{
    public static function make(mixed ...$args): self
    {
        if (count($args) === 1 && is_array($args[0])) {
            $args = $args[0];
        }

        return new self(...$args); // @phpstan-ignore-line
    }
}
