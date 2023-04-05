<?php

namespace Mhajdu\PayitGateway\Controllers;

use Illuminate\Support\Facades\Http;
use Mhajdu\PayitGateway\Traits\Helpers;

class PaymentController {
    use Helpers;

    protected $config;

    public static $urls = [
        'create' => [
            'url' => '/payments',
            'method' => 'POST',
        ],
        'get' => [
            'url' => '/payments/get',
            'method' => 'GET',
        ]
    ];

    public function __construct($config) {
        $this->config = $config;
    }

    public function createPayment($payment) {
        $body = [
            //TODO: payment validation
        ];
        $response = Http::post($this->config->getPayitUrl() . self::$urls['create']['url'], [
            'application_key' => $this->config->getKey(),
            'data' => $this->encryptData($body)
        ]);

        return $response->json();
    }

    public function fetchPayment($payment_id) {
        $body = [
            'payment_id' => $payment_id
        ];
        $response = Http::get($this->config->getPayitUrl() . self::$urls['get']['url'], [
            'application_key' => $this->config->getKey(),
            'data' => $this->encryptData($body)
        ]);

        return $response->json();
    }
}