<?php

namespace App\Services;

use App\Services\PaymentGatewayInterface;

class PaypalService implements PaymentGatewayInterface
{
    public function charge(int $amount, string $currency = 'usd', string $token = null): string
    {
        // Mock logic for now
        return 'paypal_transaction_id_'.uniqid();
    }
}
