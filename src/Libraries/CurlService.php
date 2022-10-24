<?php

namespace TheBachtiarz\Account\Libraries;

use TheBachtiarz\Account\Interfaces\Library\UrlDomainInterface;
use TheBachtiarz\Toolkit\Helper\Curl\CurlRestService;

class CurlService
{
    use CurlRestService;

    /**
     * Base domain resolver
     *
     * @override
     * @param boolean $productionMode
     * @return string
     */
    private static function baseDomainResolver(bool $productionMode = true): string
    {
        return $productionMode ? tbaccountconfig('api_url_production') : tbaccountconfig('api_url_sandbox');
    }

    /**
     * Url end point resolver
     *
     * @override
     * @return string
     */
    private static function urlResolver(): string
    {
        $_baseDomain = self::baseDomainResolver(tbaccountconfig('is_production_mode'));

        $_prefix = tbaccountconfig('api_url_prefix');

        $_endPoint = UrlDomainInterface::URL_DOMAIN_AVAILABLE[self::$url];

        return "{$_baseDomain}/{$_prefix}/{$_endPoint}";
    }
}
