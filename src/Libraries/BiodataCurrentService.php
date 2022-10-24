<?php

namespace TheBachtiarz\Account\Libraries;

use TheBachtiarz\Account\Interfaces\Library\LibraryServiceInterface;

class BiodataCurrentService extends CurlService implements LibraryServiceInterface
{
    //

    /**
     * {@inheritDoc}
     */
    public function execute(array $data): array
    {
        return self::setUrl(self::URL_DOMAIN_GETCURRENTBIODATA_NAME)->setData($data)->get();
    }
}
