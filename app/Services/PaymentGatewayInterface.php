<?php

namespace App\Services;

interface PaymentGatewayInterface
{
    public function charge(int $amount, string $currency = 'usd', string $token = null): string;
}
