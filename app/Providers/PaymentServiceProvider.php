<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PaymentGatewayInterface;
use App\Services\StripeService;
use App\Services\PaypalService;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGatewayInterface::class, function ($app) {
            $gateway = request()->input('gateway', 'stripe');

            switch ($gateway) {
                case 'paypal':
                    return new PaypalService();
                default:
                    return new StripeService();
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
