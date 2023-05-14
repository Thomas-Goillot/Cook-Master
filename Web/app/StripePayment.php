<?php

namespace App;

use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripePayment extends Controller{

    public function __construct(readonly private string $clientSecret)
    {
        Stripe::setApiKey($clientSecret);
        Stripe::setApiVersion('2022-11-15');
    }

    /**
     * Start the payment    
     */
    public function startPayment(int $sum, array $products, string $email,$succesPath= 'http://localhost/Cook-Master/WEB/shop/success',$cancelPath = 'http://localhost/Cook-Master/WEB/shop/cancel'): void
    {
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
            'success_url' => $succesPath,
            'cancel_url' => $cancelPath,
            'customer_email' => $email,
          ]);

        $this->redirect($session->url);

    }

}