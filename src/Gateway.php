<?php

namespace Mhajdu\PayitGateway;

use http\Env\Request;
use Illuminate\Encryption\Encrypter;
use Mhajdu\PayitGateway\Controllers\CustomerController;
use Mhajdu\PayitGateway\Controllers\PaymentController;
use Mhajdu\PayitGateway\Controllers\ProcessController;
use Mhajdu\PayitGateway\Traits\Configuration;

class Gateway {
    use Configuration;

    public $customerController, $paymentController;
    public function __construct($key = null, $secret = null) {
        $this->createConfiguration($key, $secret);
    }

    public function customer(): CustomerController {
        if(!$this->customerController instanceof CustomerController) {
            $this->customerController = new CustomerController();
        }
        return $this->customerController;
    }

    public function payment(): PaymentController {
        if(!$this->paymentController instanceof PaymentController) {
            $this->paymentController = new PaymentController();
        }
        return $this->paymentController;
    }

    public function createCustomer($customer) {
        return $this->customer()->createCustomer($customer);
    }

    public function createPayment($payment) {
        return $this->payment()->createPayment($payment);
    }

    public function getCustomer($customer_id) {
        return $this->customer()->fetchCustomer($customer_id);
    }

    public function getCustomerPayments($customer_id) {
        return $this->customer()->fetchPayments($customer_id);
    }

    public function getPayment($payment_id) {
        return $this->payment()->fetchPayment($payment_id);
    }

    public function processPayment(Request $request) {
        return new ProcessController($request);
    }
}