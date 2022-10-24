<?php

namespace TheBachtiarz\Account\Models;

use TheBachtiarz\Auth\Models\User as TheBachtiarzAuthUserModel;
use TheBachtiarz\Account\Interfaces\Model\UserModelInterface;
use TheBachtiarz\Account\Traits\Model\UserAccountRelationTrait;
use TheBachtiarz\AdditionalAttribute\Service\AdditionalAttributes;

class User extends TheBachtiarzAuthUserModel implements UserModelInterface
{
    use AdditionalAttributes;

    use UserAccountRelationTrait;
}
