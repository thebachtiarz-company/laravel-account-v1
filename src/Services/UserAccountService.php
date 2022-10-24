<?php

namespace TheBachtiarz\Account\Services;

use TheBachtiarz\Account\Helpers\UserAccountHelper;
use TheBachtiarz\Account\Libraries\AccountCreateService;
use TheBachtiarz\Account\Libraries\AccountDetailService;
use TheBachtiarz\Account\Libraries\BiodataCreateService;
use TheBachtiarz\Account\Libraries\BiodataCurrentService;
use TheBachtiarz\Account\Libraries\BiodataUpdateService;
use TheBachtiarz\Account\Models\User;
use TheBachtiarz\Account\Models\UserAccount;
use TheBachtiarz\Account\Repositories\UserAccountRepository;
use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;

class UserAccountService
{
    use CarbonHelper;

    /**
     * User Account Repository
     *
     * @var UserAccountRepository
     */
    protected UserAccountRepository $userAccountRepository;

    /**
     * Account Create Service
     *
     * @var AccountCreateService
     */
    protected AccountCreateService $accountCreateService;

    /**
     * Account Detail Service
     *
     * @var AccountDetailService
     */
    protected AccountDetailService $accountDetailService;

    /**
     * Biodata Create Service
     *
     * @var BiodataCreateService
     */
    protected BiodataCreateService $biodataCreateService;

    /**
     * Biodata Current Service
     *
     * @var BiodataCurrentService
     */
    protected BiodataCurrentService $biodataCurrentService;

    /**
     * Biodata Update Service
     *
     * @var BiodataUpdateService
     */
    protected BiodataUpdateService $biodataUpdateService;

    /**
     * User Account Helper
     *
     * @var UserAccountHelper
     */
    protected UserAccountHelper $userAccountHelper;

    /**
     * Constructor
     *
     * @param UserAccountRepository $userAccountRepository
     * @param AccountCreateService $accountCreateService
     * @param AccountDetailService $accountDetailService
     * @param BiodataCreateService $biodataCreateService
     * @param BiodataCurrentService $biodataCurrentService
     * @param BiodataUpdateService $biodataUpdateService
     * @param UserAccountHelper $userAccountHelper
     */
    public function __construct(
        UserAccountRepository $userAccountRepository,
        AccountCreateService $accountCreateService,
        AccountDetailService $accountDetailService,
        BiodataCreateService $biodataCreateService,
        BiodataCurrentService $biodataCurrentService,
        BiodataUpdateService $biodataUpdateService,
        UserAccountHelper $userAccountHelper
    ) {
        $this->userAccountRepository = $userAccountRepository;
        $this->accountCreateService = $accountCreateService;
        $this->accountDetailService = $accountDetailService;
        $this->biodataCreateService = $biodataCreateService;
        $this->biodataCurrentService = $biodataCurrentService;
        $this->biodataUpdateService = $biodataUpdateService;
        $this->userAccountHelper = $userAccountHelper;
    }

    // ? Public Methods
    /**
     * Create new account with biodata
     *
     * @param User $user
     * @param array $newBiodata
     * @return array
     */
    public function createNewAccount(User $user, array $newBiodata): array
    {
        $_newAccount = $this->accountCreateService->execute($newBiodata);

        throw_if(!$_newAccount['status'], 'Exception', $_newAccount['message']);

        $_userAccount = (new UserAccount)
            ->setUserId($user->getId())
            ->setCode($_newAccount['code'])
            ->setData($this->userAccountHelper->encryptBiodata($_newAccount['biodatas']));

        $this->userAccountRepository->create($_userAccount);

        return $this->getUserAccountBiodata($user);
    }

    /**
     * Get account detail from user
     *
     * @param User $user
     * @return array
     */
    public function getUserAccountBiodata(User $user): array
    {
        $_account = $this->userAccountRepository->getByUser($user);

        return [
            'account_code' => $_account->getCode(),
            'account_biodatas' => $this->userAccountHelper->decryptBiodata($_account->getData())
        ];
    }

    /**
     * Create new biodata into current account
     *
     * @param User $user
     * @param array $newBiodata
     * @return array
     */
    public function createNewBiodata(User $user, array $newBiodata): array
    {
        $_account = $this->userAccountRepository->getByUser($user);

        $newBiodata['code'] = $_account->getCode();

        $_newBiodata = $this->biodataCreateService->execute($newBiodata);

        throw_if(!$_newBiodata['status'], 'Exception', $_newBiodata['message']);

        $_account = $this->pushNewBiodata($_account, $_newBiodata['response_data']);

        $_decryptedBiodatas = $this->userAccountHelper->decryptBiodata($_account->getData());

        return end($_decryptedBiodatas);
    }

    /**
     * Get current biodata from current account
     *
     * @param User $user
     * @return array
     */
    public function getCurrentBiodata(User $user): array
    {
        $_account = $this->userAccountRepository->getByUser($user);

        $_decryptedBiodatas = $this->userAccountHelper->decryptBiodata($_account->getData());

        return end($_decryptedBiodatas);
    }

    /**
     * Update current biodata from current account
     *
     * @param User $user
     * @param array $updateBiodata
     * @return array
     */
    public function updateCurrentBiodata(User $user, array $updateBiodata): array
    {
        $_account = $this->userAccountRepository->getByUser($user);

        $_currentBiodata = $this->getCurrentBiodata($user);

        $_replaceBiodata = array_merge($_currentBiodata, $updateBiodata);

        $_replaceBiodata['code'] = $_account->getCode();

        $_updateBiodata = $this->biodataUpdateService->execute($_replaceBiodata);

        throw_if(!$_updateBiodata['status'], 'Exception', $_updateBiodata['message']);

        $_account = $this->replaceCurrentBiodata($_account, $_updateBiodata['response_data']);

        $_decryptedBiodatas = $this->userAccountHelper->decryptBiodata($_account->getData());

        return end($_decryptedBiodatas);
    }

    // ? Private Methods
    /**
     * Push new biodata into account
     *
     * @param UserAccount $userAccount
     * @param array $newBiodata
     * @return UserAccount
     */
    private function pushNewBiodata(UserAccount $userAccount, array $newBiodata): UserAccount
    {
        $_decryptedBiodatas = $this->userAccountHelper->decryptBiodata($userAccount->getData());

        $_decryptedBiodatas[] = $newBiodata;

        $userAccount->setData($this->userAccountHelper->encryptBiodata($_decryptedBiodatas));

        return $this->userAccountRepository->save($userAccount);
    }

    /**
     * Replace current biodata in account
     *
     * @param UserAccount $userAccount
     * @param array $replacedBiodata
     * @return UserAccount
     */
    private function replaceCurrentBiodata(UserAccount $userAccount, array $replacedBiodata): UserAccount
    {
        $_decryptedBiodatas = $this->userAccountHelper->decryptBiodata($userAccount->getData());

        foreach ($_decryptedBiodatas as $key => &$biodata) {
            if (self::anyConvDateToTimestamp($biodata['created_at']) === self::anyConvDateToTimestamp($replacedBiodata['created_at'])) {
                $biodata = $replacedBiodata;
            }
        }

        $userAccount->setData($this->userAccountHelper->encryptBiodata($_decryptedBiodatas));

        return $this->userAccountRepository->save($userAccount);
    }

    // ? Setter Modules
}
