<?php

namespace Mhajdu\PayitGateway\Controllers;

use Mhajdu\PayitGateway\Configuration;
use Mhajdu\PayitGateway\Traits\Helpers;

class ProcessController {

    use Helpers;

    protected $request, $config;
    public function __construct(Configuration $config, $request) {
        $this->request = $request;
        $this->requestData = $this->decryptData($request->data);
        $this->config = $config;
    }

    public function failed() {
        return $this->requestData['status'] != 'success';
    }

    public function successful() {
        return $this->requestData['status'] == 'success';
    }
}