<?php

namespace TheBachtiarz\Account\Traits\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use TheBachtiarz\Account\Interfaces\Model\UserAccountModelInterface;
use TheBachtiarz\Account\Models\UserAccount;

/**
 * User Account Relation Trait.
 * Used in child class where parent is.
 * @override \TheBachtiarz\Auth\Models\User::class
 */
trait UserAccountRelationTrait
{
    //

    // ? Relations
    /**
     * Relation user account has one
     *
     * @return HasOne
     */
    public function useraccount(): HasOne
    {
        return $this->hasOne(UserAccount::class, UserAccountModelInterface::USER_ACCOUNT_ATTRIBUTE_USERID);
    }
}
