<?php

namespace TheBachtiarz\Account\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use TheBachtiarz\Account\Interfaces\Model\UserAccountModelInterface;
use TheBachtiarz\Account\Models\User;

/**
 * User Account Scope Trait
 */
trait UserAccountScopeTrait
{
    /**
     * Get by user
     *
     * @param Builder $builder
     * @param User $user
     * @return Builder
     */
    public function scopeGetByUser(Builder $builder, User $user): Builder
    {
        return $builder->where(UserAccountModelInterface::USER_ACCOUNT_ATTRIBUTE_USERID, $user->getId());
    }

    /**
     * Get by code
     *
     * @param Builder $builder
     * @param string $accountCode
     * @return Builder
     */
    public function scopeGetByCode(Builder $builder, string $accountCode): Builder
    {
        $_accountCodeAttribute = UserAccountModelInterface::USER_ACCOUNT_ATTRIBUTE_CODE;

        return $builder->where(DB::raw("BINARY `$_accountCodeAttribute`"), $accountCode);
    }
}
