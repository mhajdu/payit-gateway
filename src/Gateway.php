<?php

namespace Mhajdu\PayitGateway;

use Illuminate\Encryption\Encrypter;
use Mhajdu\PayitGateway\Controllers\CustomerController;
use Mhajdu\PayitGateway\Traits\Configuration;

class Gateway {
    use Configuration;

    public $customerController;
    public function __construct($key = null, $secret = null) {
        $this->createConfiguration($key, $secret);
    }

    public function customer(): CustomerController {
        if(!$this->customerController instanceof CustomerController) {
            $this->customerController = new CustomerController();
        }
        return $this->customerController;
    }

    public function getCustomer($customer_id) {
        return $this->customer()->fetchCustomer($customer_id);
    }
}