<?php

namespace Mhajdu\PayitGateway;

class Configuration {
    protected $key, $secret, $payit_url;

    /**
     * @param $key
     * @param $secret
     * @return void
     */
    public function createConfiguration($key = null, $secret = null) {
        $this->key = $key ?? env('PAYIT_KEY');
        $this->secret = $secret ?? env('PAYIT_SECRET');

        if(!$this->key || !$this->secret) {
            throw new \Exception('Missing Payit key or secret, check if you have set PAYIT_KEY and PAYIT_SECRET in your .env file');
        }

        if(env('PAYIT_ENV') == 'local' || env('APP_ENV') == 'local') {
            $this->payit_url = 'https://payit.sk/dev';
        } else {
            $this->payit_url = 'https://payit.sk/api/v1';
        }
    }

    /**
     * @return mixed
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getPayitUrl() {
        return $this->payit_url;
    }

    /**
     * @return mixed
     */
    public function getSecret() {
        return $this->secret;
    }
}