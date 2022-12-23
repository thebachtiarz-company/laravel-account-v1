<?php

namespace TheBachtiarz\Account\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TheBachtiarz\Account\Interfaces\Model\UserAccountModelInterface;
use TheBachtiarz\Account\Interfaces\Model\UserModelInterface;
use TheBachtiarz\Account\Traits\Model\UserAccountScopeTrait;
use TheBachtiarz\AdditionalAttribute\Services\AdditionalAttributes;

class UserAccount extends Model implements UserAccountModelInterface
{
    use AdditionalAttributes;

    use UserAccountScopeTrait;

    /**
     * {@inheritDoc}
     */
    protected $fillable = self::USER_ACCOUNT_ATTRIBUTES_FILLABLE;

    /**
     * Account code
     *
     * @var string
     */
    protected string $code;

    /**
     * Account data
     *
     * @var string
     */
    protected string $data;

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        return $this->__get(self::USER_ACCOUNT_ATTRIBUTE_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserId(): ?int
    {
        return $this->__get(self::USER_ACCOUNT_ATTRIBUTE_USERID);
    }

    /**
     * {@inheritDoc}
     */
    public function getCode(): ?string
    {
        return $this->__get(self::USER_ACCOUNT_ATTRIBUTE_CODE);
    }

    /**
     * {@inheritDoc}
     */
    public function getData(): ?string
    {
        return $this->__get(self::USER_ACCOUNT_ATTRIBUTE_DATA);
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setId(int $id): self
    {
        $this->__set(self::USER_ACCOUNT_ATTRIBUTE_ID, $id);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setUserId(int $userId): self
    {
        $this->__set(self::USER_ACCOUNT_ATTRIBUTE_USERID, $userId);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setCode(string $code): self
    {
        $this->__set(self::USER_ACCOUNT_ATTRIBUTE_CODE, $code);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setData(string $data): self
    {
        $this->__set(self::USER_ACCOUNT_ATTRIBUTE_DATA, $data);

        return $this;
    }

    // ? Relations
    /**
     * Relation user belongs to
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            self::USER_ACCOUNT_ATTRIBUTE_USERID,
            UserModelInterface::USER_ATTRIBUTE_ID
        );
    }
}
