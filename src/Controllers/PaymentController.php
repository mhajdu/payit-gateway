<?php

namespace Mhajdu\PayitGateway\Controllers;

use Mhajdu\PayitGateway\Traits\Helpers;

class PaymentController {
    use Helpers;

    public static $urls = [
        'create' => [
            'url' => '/payment',
            'method' => 'POST',
        ],
        'get' => [
            'url' => '/payment/get',
            'method' => 'GET',
        ]
    ];

    public function createPayment($payment) {
        $body = [
            //TODO: payment validation
        ];
        $response = Http::post($this->payit_url . $this->urls['create']['url'], [
            'application_key' => $this->key,
            'data' => $this->encryptData($body)
        ]);

        return $response->json();
    }

    public function fetchPayment($payment_id) {
        $body = [
            'payment_id' => $payment_id
        ];
        $response = Http::get($this->payit_url . $this->urls['get']['url'], [
            'application_key' => $this->key,
            'data' => $this->encryptData($body)
        ]);

        return $response->json();
    }
}