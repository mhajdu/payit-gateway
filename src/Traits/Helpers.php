<?php

namespace Mhajdu\PayitGateway\Traits;

use Illuminate\Encryption\Encrypter;

trait Helpers {
    public function decryptData($data):string {
        $encrypter = new Encrypter($this->config->getSecret(), 'AES-256-CBC');
        return $encrypter->decrypt($data);
    }

    /**
     * @param $data
     * @return string
     */
    public function encryptData($data): string {
        if(!isset($data['request_time'])) {
            $data['request_time'] = date('Y-m-d H:i:s');
        }
        $encrypter = new Encrypter($this->config->getSecret(), 'AES-256-CBC');
        return $encrypter->encrypt($data);
    }
}