<?php

namespace TheBachtiarz\Account\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Account\Models\User;
use TheBachtiarz\Account\Models\UserAccount;

class UserAccountRepository
{
    //

    // ? Public Methods
    /**
     * Get account by user
     *
     * @param User $user
     * @return UserAccount
     */
    public function getByUser(User $user): UserAccount
    {
        $_userAccount = UserAccount::getByUser($user)->first();

        if (!$_userAccount) throw new ModelNotFoundException("Cannot find account for current user");

        return $_userAccount;
    }

    /**
     * Get account by code
     *
     * @param string $code
     * @return UserAccount|null
     */
    public function getByCode(string $code): ?UserAccount
    {
        $_userAccount = UserAccount::getByCode($code)->first();

        // if (!$_userAccount) throw new ModelNotFoundException("Account with code '$code' not found");

        return $_userAccount;
    }

    /**
     * Create new account
     *
     * @param UserAccount $userAccount
     * @return UserAccount
     */
    public function create(UserAccount $userAccount): UserAccount
    {
        $_data = [];

        foreach ($userAccount->getFillable() as $key => $attribute) {
            $_data[$attribute] = $userAccount->__get($attribute);
        }

        $_create = UserAccount::create($_data);

        if (!$_create) throw new ModelNotFoundException("Failed to create new user status");

        return $_create;
    }

    /**
     * Save current account
     *
     * @param UserAccount $userAccount
     * @return UserAccount
     */
    public function save(UserAccount $userAccount): UserAccount
    {
        $_userAccount = $userAccount->save();

        if (!$_userAccount) throw new ModelNotFoundException("Failed to save current account");

        return $userAccount;
    }

    /**
     * Delete account by user
     *
     * @param User $user
     * @return boolean
     */
    public function deleteByUser(User $user): bool
    {
        $_userAccount = $this->getByUser($user);

        $_delete = $_userAccount->delete();

        if (!$_delete) throw new ModelNotFoundException("Failed to delete account for current user");

        return $_delete;
    }

    /**
     * Delete account by code
     *
     * @param string $code
     * @return boolean
     */
    public function deleteByCode(string $code): bool
    {
        $_userAccount = $this->getByCode($code);

        $_delete = $_userAccount->delete();

        if (!$_delete) throw new ModelNotFoundException("Failed to delete account with code '$code'");

        return $_delete;
    }

    // ? Private Methods

    // ? Setter Modules
}
