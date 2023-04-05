<?php

namespace Mhajdu\PayitGateway\Controllers;

use Mhajdu\PayitGateway\Traits\Helpers;

class ProcessController {

    use Helpers;

    protected $request;
    public function __construct($request) {
        $this->request = $request;
        $this->requestData = $this->decryptData($request->data);
    }

    public function failed() {
        return $this->requestData['status'] != 'success';
    }

    public function successful() {
        return $this->requestData['status'] == 'success';
    }
}