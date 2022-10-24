<?php

namespace TheBachtiarz\Account\Interfaces\Model;

interface UserAccountModelInterface
{
    /**
     * Model attributes fillable
     *
     * @var array
     */
    public const USER_ACCOUNT_ATTRIBUTES_FILLABLE = [
        self::USER_ACCOUNT_ATTRIBUTE_USERID,
        self::USER_ACCOUNT_ATTRIBUTE_CODE,
        self::USER_ACCOUNT_ATTRIBUTE_DATA
    ];

    public const USER_ACCOUNT_ATTRIBUTE_ID = 'id';
    public const USER_ACCOUNT_ATTRIBUTE_USERID = 'user_id';
    public const USER_ACCOUNT_ATTRIBUTE_CODE = 'code';
    public const USER_ACCOUNT_ATTRIBUTE_DATA = 'data';

    // ? Getter Modules
    /**
     * Get id
     *
     * @return integer|null
     */
    public function getId(): ?int;

    /**
     * Get user id
     *
     * @return integer|null
     */
    public function getUserId(): ?int;

    /**
     * Get account code
     *
     * @return string|null
     */
    public function getCode(): ?string;

    /**
     * Get account data
     *
     * @return string|null
     */
    public function getData(): ?string;

    // ? Setter Modules
    /**
     * Set id
     *
     * @param integer $id
     * @return self
     */
    public function setId(int $id): self;

    /**
     * Set user id
     *
     * @param integer $userId
     * @return self
     */
    public function setUserId(int $userId): self;

    /**
     * Set account code
     *
     * @param string $code
     * @return self
     */
    public function setCode(string $code): self;

    /**
     * Set account data
     *
     * @param string $data
     * @return self
     */
    public function setData(string $data): self;
}
