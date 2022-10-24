<?php

namespace TheBachtiarz\Account\Helpers;

use TheBachtiarz\Toolkit\Helper\App\Encryptor\EncryptorHelper;

class UserAccountHelper
{
    use EncryptorHelper;

    // ? Public
    /**
     * Encrypt account biodata(s)
     *
     * @param array $biodatas
     * @return string
     */
    public function encryptBiodata(array $biodatas = []): string
    {
        $_result = '';

        try {
            $_result = self::simpleEncrypt($biodatas);
        } catch (\Throwable $th) {
        } finally {
            return $_result;
        }
    }

    // ? Private Methods
    /**
     * Decrypt account biodata(s)
     *
     * @param string $encryptedBiodatas
     * @return array
     */
    public function decryptBiodata(string $encryptedBiodatas): array
    {
        $_result = [];

        try {
            $_result = self::decrypt($encryptedBiodatas);
        } catch (\Throwable $th) {
        } finally {
            return $_result;
        }
    }

    // ? Setter Modules
}
