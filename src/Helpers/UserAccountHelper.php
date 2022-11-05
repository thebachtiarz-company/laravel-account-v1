<?php

namespace TheBachtiarz\Account\Helpers;

use TheBachtiarz\Toolkit\Helper\App\Encryptor\EncryptorHelper;

class UserAccountHelper
{
    use EncryptorHelper;

    // ? Public Methods
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

    /**
     * Resolve encrypted biodata
     *
     * @param string $encryptedBiodata
     * @param boolean $onlyLatest
     * @return array
     */
    public function biodataResolver(string $encryptedBiodata, bool $onlyLatest = false): array
    {
        $_biodatas = $this->decryptBiodata($encryptedBiodata);

        return $onlyLatest ? $_biodatas : end($_biodatas);
    }

    // ? Private Methods

    // ? Setter Modules
}
