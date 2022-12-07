<?php

namespace TheBachtiarz\Account\Libraries;

use TheBachtiarz\Account\Interfaces\Library\UrlDomainInterface;
use TheBachtiarz\Toolkit\Helper\Curl\AbstractCurl;

class CurlService extends AbstractCurl
{
    /**
     * {@override}
     *
     * @return string
     */
    protected function urlDomainResolver(): string
    {
        $_baseDomain = tbaccountconfig('is_production_mode') ? tbaccountconfig('api_url_production') : tbaccountconfig('api_url_sandbox');
        $_prefix = tbaccountconfig('api_url_prefix');
        $_endPoint = UrlDomainInterface::URL_DOMAIN_AVAILABLE[$this->getUrl()];

        return "{$_baseDomain}/{$_prefix}/{$_endPoint}";
    }

    /**
     * {@inheritDoc}
     */
    protected function bodyDataResolver(): array
    {
        return $this->body;
    }
}
