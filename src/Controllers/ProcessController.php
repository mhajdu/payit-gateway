<?php

namespace Mhajdu\PayitGateway\Controllers;

class ProcessController {
    protected $request;
    public function __construct($request) {
        $this->request = $request;
    }
    public function successful() {
        return $this->request->successful();
    }
}