<?php

namespace Mhajdu\PayitGateway;

use http\Env\Request;
use Illuminate\Encryption\Encrypter;
use Mhajdu\PayitGateway\Controllers\CustomerController;
use Mhajdu\PayitGateway\Controllers\PaymentController;
use Mhajdu\PayitGateway\Controllers\ProcessController;

class Gateway {
    public $customerController, $paymentController, $config;
    public function __construct($key = null, $secret = null) {
        //$this->createConfiguration($key, $secret);
        $this->config = new Configuration($key, $secret);
    }

    public function customer(): CustomerController {
        if(!$this->customerController instanceof CustomerController) {
            $this->customerController = new CustomerController($this->config);
        }
        return $this->customerController;
    }

    public function payment(): PaymentController {
        if(!$this->paymentController instanceof PaymentController) {
            $this->paymentController = new PaymentController($this->config);
        }
        return $this->paymentController;
    }

    public function createCustomer($customer) {
        return $this->customer()->createCustomer($customer);
    }

    public function createPayment($payment) {
        return $this->payment()->createPayment($payment);
    }

    public function createPaymentWithCustomer($payment, $customer) {
        $customer = $this->customer()->createCustomer($customer);
        if(isset($customer['id'])) {
            $payment['customer_id'] = $customer['id'];
            $pm = $this->payment()->createPayment($payment);
            if(isset($pm['payment']['id'])) {
                return [
                    'customer' => $customer,
                    ...$pm
                ];
            }
            throw new \Exception('Payment creation failed');
        }
        throw new \Exception('Customer creation failed');
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
        return new ProcessController($this->config, $request);
    }
}