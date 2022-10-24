<?php

namespace TheBachtiarz\Account\Interfaces\Library;

interface LibraryServiceInterface extends UrlDomainInterface
{
    /**
     * Execute service process
     *
     * @param array $data
     * @return array
     */
    public function execute(array $data): array;
}
