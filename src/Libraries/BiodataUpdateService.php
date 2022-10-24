<?php

namespace TheBachtiarz\Account\Libraries;

use TheBachtiarz\Account\Interfaces\Library\LibraryServiceInterface;

class BiodataUpdateService extends CurlService implements LibraryServiceInterface
{
    //

    /**
     * {@inheritDoc}
     */
    public function execute(array $data): array
    {
        return self::setUrl(self::URL_DOMAIN_UPDATECURRENTBIODATA_NAME)->setData($data)->post();
    }
}
