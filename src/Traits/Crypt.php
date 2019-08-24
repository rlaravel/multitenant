<?php

namespace RafaelMorenoJS\MultiTenant\Traits;

/**
 * Trait Crypt
 * @package RafaelMorenoJS\MultiTenant\Traits
 */
trait Crypt
{
    /**
     * @param array $data
     * @return string
     */
    public function encrypt(array $data): string
    {
        $data = json_encode($data);
        return openssl_encrypt($data, config('app.cipher'), config('tenant.crypt_pass'), 0, '1234567890123456');
    }
    /**
     * @param string $data
     * @return array
     */
    public function decrypt(string $data): array
    {
        $data = openssl_decrypt($data, config('app.cipher'), config('tenant.crypt_pass'), 0, '1234567890123456');
        return json_decode($data, true);
    }
}
