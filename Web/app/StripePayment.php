<?php

namespace App;

use App\Utils;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripePayment extends Controller{

    public function __construct(readonly private string $clientSecret)
    {
        Stripe::setApiKey($clientSecret);
        Stripe::setApiVersion('2022-11-15');
    }

    /**
     * Start the payment    
     */
    public function startPayment(array $products, string $email, string $succesPath= 'shop/success', string $cancelPath = 'shop/cancel'): void
    {
        $utils = new Utils();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                array_map(function ($product) {
                    return [
                        'price_data' => [
                            'currency' => 'EUR',
                            'product_data' => [
                                'name' => $product['name'],
                            ],
                            'unit_amount' => $product['price_purchase'] * 100,
                        ],
                        'quantity' => $product['quantity'],
                    ];
                }, $products),
            ],
            'mode' => 'payment',
            'success_url' => $utils->getDomainName() . $succesPath . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $utils->getDomainName() . $cancelPath . '?session_id={CHECKOUT_SESSION_ID}',
            'customer_email' => $email,
          ]);

        $this->redirect($session->url);
    }

    /**
     * Get the payment status
     */
    public function getPaymentStatus(string $sessionId): string
    {
        $session = Session::retrieve($sessionId);
        return $session->payment_status;
    }
}