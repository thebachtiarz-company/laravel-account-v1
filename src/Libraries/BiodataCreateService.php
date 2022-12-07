<?php

namespace TheBachtiarz\Account\Libraries;

use TheBachtiarz\Account\Interfaces\Library\LibraryServiceInterface;

class BiodataCreateService extends CurlService implements LibraryServiceInterface
{
    //

    /**
     * Curl Service
     *
     * @var CurlService
     */
    protected CurlService $curlService;

    /**
     * Constructor
     *
     * @param CurlService $curlService
     */
    public function __construct(
        CurlService $curlService
    ) {
        $this->curlService = $curlService;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(array $data): array
    {
        return $this->curlService->setUrl(self::URL_DOMAIN_CREATENEWBIODATA_NAME)->setBody($data)->post();
    }
}
