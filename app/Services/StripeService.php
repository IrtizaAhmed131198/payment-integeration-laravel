<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Charge;

class StripeService implements PaymentGatewayInterface
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function charge(int $amount, string $currency = 'usd', string $token = null): string
    {
        $charge = Charge::create([
            'amount' => $amount * 100, // in cents
            'currency' => $currency,
            'source' => $token,
            'description' => 'Test Stripe Charge',
        ]);

        return $charge->id;
    }
}
