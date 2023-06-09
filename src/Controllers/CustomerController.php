<?php

namespace Mhajdu\PayitGateway\Controllers;

use Illuminate\Support\Facades\Http;
use Mhajdu\PayitGateway\Traits\Helpers;

class CustomerController {
    use Helpers;

    protected $config;

    public static $urls = [
        'create' => [
            'url' => '/customers',
            'method' => 'POST',
        ],
        'get' => [
            'url' => '/customers/get',
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
        $response = Http::post($this->config->getPayitUrl() . self::$urls['create']['url'], [
            'application_key' => $this->config->getKey(),
            'data' => $this->encryptData($body)
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception($response->json()['message']);
        }
    }

    public function fetchCustomer($customer_id) {
        $body = [
            'customer_id' => $customer_id
        ];
        $response = Http::get($this->config->getPayitUrl() . self::$urls['get']['url'], [
            'application_key' => $this->config->getKey(),
            'data' => $this->encryptData($body)
        ]);

        if($response->successful()) {
            return $response->json();
        } else if($response->status() == 404) {
            throw new \Exception('Customer not found');
        } else {
            throw new \Exception($response->json()['message']);
        }
    }

    public function fetchPayments($customer_id) {
        $body = [
            'customer_id' => $customer_id
        ];
        $response = Http::get($this->config->payit_url . PaymentController::$urls['get']['url'], [
            'application_key' => $this->config->key,
            'data' => $this->encryptData($body)
        ]);

        return $response->json();
    }
}