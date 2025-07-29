<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentGatewayInterface;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('payment.form');
    }

    public function makePayment(Request $request, PaymentGatewayInterface $payment)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'gateway' => 'required|in:stripe,paypal',
            'stripeToken' => 'required_if:gateway,stripe',
        ]);

        $transactionId = $payment->charge($request->amount, 'usd', $request->stripeToken ?? null);

        return redirect()->back()->with('success', 'Payment successful via ' . $request->gateway . '. Transaction ID: ' . $transactionId);
    }
}
