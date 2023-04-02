<?php

namespace Mhajdu\PayitGateway\Controllers;

use Illuminate\Support\Facades\Http;
use Mhajdu\PayitGateway\Traits\Helpers;

class CustomerController {
    use Helpers;
    public $urls = [
        'create' => [
            'url' => '/customer',
            'method' => 'POST',
        ],
        'update' => [
            'url' => '/customer',
            'method' => 'POST',
        ],
        'delete' => [
            'url' => '/customer',
            'method' => 'DELETE',
        ],
        'get' => [
            'url' => '/customer/get',
            'method' => 'GET',
        ]
    ];

    public function fetchCustomer($customer_id) {
        $body = [
            'customer_id' => $customer_id
        ];
        $response = Http::get($this->payit_url . $this->urls['get']['url'], [
            'application_key' => $this->key,
            'data' => $this->encryptData($body)
        ]);

        return $response->json();
    }
}