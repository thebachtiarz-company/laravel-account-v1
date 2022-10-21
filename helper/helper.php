<?php

use TheBachtiarz\Account\Interfaces\Config\AccountConfigInterface;

/**
 * TheBachtiarz account config
 *
 * @param string|null $keyName config key name | null will return all
 * @return mixed
 */
function tbaccountconfig(?string $keyName = null): mixed
{
    $configName = AccountConfigInterface::ACCOUNT_CONFIG_NAME;

    return iconv_strlen($keyName)
        ? config("{$configName}.{$keyName}")
        : config("{$configName}");
}
