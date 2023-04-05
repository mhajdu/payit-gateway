<?php

namespace Mhajdu\PayitGateway\Controllers;

use Illuminate\Support\Facades\Http;
use Mhajdu\PayitGateway\Traits\Helpers;

class CustomerController {
    use Helpers;

    public $config;

    public static $urls = [
        'create' => [
            'url' => '/customer',
            'method' => 'POST',
        ],
        'get' => [
            'url' => '/customer/get',
            'method' => 'GET',
        ]
    ];

    public function __construct($config) {
        $this->config = $config;
    }

    public function createCustomer($customer) {
        $body = [
            'name' => $customer['name'] ?? '',
            'email' => $customer['email'] ?? '',
            'phone' => $customer['phone'] ?? '',
            'address' => $customer['address'] ?? '',
            'city' => $customer['city'] ?? '',
            'zip' => $customer['zip'] ?? '',
            'country' => $customer['country'] ?? '',
        ];
        $response = Http::post($this->payit_url . self::$urls['create']['url'], [
            'application_key' => $this->key,
            'data' => $this->encryptData($body)
        ]);

        return $response->json();
    }

    public function fetchCustomer($customer_id) {
        $body = [
            'customer_id' => $customer_id
        ];
        $response = Http::get($this->payit_url . self::$urls['get']['url'], [
            'application_key' => $this->key,
            'data' => $this->encryptData($body)
        ]);

        return $response->json();
    }

    public function fetchPayments($customer_id) {
        $body = [
            'customer_id' => $customer_id
        ];
        $response = Http::get($this->payit_url . PaymentController::$urls['get']['url'], [
            'application_key' => $this->key,
            'data' => $this->encryptData($body)
        ]);

        return $response->json();
    }
}