<?php

namespace Mhajdu\PayitGateway\Traits;

use Illuminate\Encryption\Encrypter;

trait Helpers {
    use Configuration;

    /**
     * @param $data
     * @return string
     */
    public function encryptData($data): string {
        if(!isset($data['request_time'])) {
            $data['request_time'] = date('Y-m-d H:i:s');
        }
        $encrypter = new Encrypter($this->secret, 'AES-256-CBC');
        return $encrypter->encrypt($data);
    }
}