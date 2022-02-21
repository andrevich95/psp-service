<?php

namespace App\Providers\Apple\Model;

use DateTimeInterface;

class ResponseBodyV1Request
{
    public const INITIAL_BUY = 'INITIAL_BUY';
    public const DID_RENEW = 'DID_RENEW';
    public const DID_FAIL_TO_RENEW = 'DID_FAIL_TO_RENEW';
    public const CANCEL = 'CANCEL';

    public const ENV_SANDBOX = 'Sandbox';
    public const ENV_PROD = 'PROD';

    private int $auto_renew_adam_id;
    private string $auto_renew_product_id;
    private bool $auto_renew_status;
    private ?DateTimeInterface $auto_renew_status_change_date = null;
    private int $auto_renew_status_change_date_ms;
    private ?DateTimeInterface $auto_renew_status_change_date_pst = null;
    private string $bid;
    private string $bvrs;
    private string $environment;
    private int $expiration_intent;
    private string $notification_type;
    private string $original_transaction_id;
    private string $password;

    public function getAutoRenewAdamId(): int
    {
        return $this->auto_renew_adam_id;
    }

    public function setAutoRenewAdamId(int $auto_renew_adam_id): self
    {
        $this->auto_renew_adam_id = $auto_renew_adam_id;
        return $this;
    }

    public function getAutoRenewProductId(): string
    {
        return $this->auto_renew_product_id;
    }

    public function setAutoRenewProductId(string $auto_renew_product_id): self
    {
        $this->auto_renew_product_id = $auto_renew_product_id;
        return $this;
    }

    public function getAutoRenewStatus(): bool
    {
        return $this->auto_renew_status;
    }

    public function setAutoRenewStatus(bool $auto_renew_status): self
    {
        $this->auto_renew_status = $auto_renew_status;
        return $this;
    }

    public function getAutoRenewStatusChangeDate(): ?DateTimeInterface
    {
        return $this->auto_renew_status_change_date;
    }

    public function setAutoRenewStatusChangeDate(?DateTimeInterface $auto_renew_status_change_date): self
    {
        $this->auto_renew_status_change_date = $auto_renew_status_change_date;
        return $this;
    }

    public function getAutoRenewStatusChangeDateMs(): int
    {
        return $this->auto_renew_status_change_date_ms;
    }

    public function setAutoRenewStatusChangeDateMs(int $auto_renew_status_change_date_ms): self
    {
        $this->auto_renew_status_change_date_ms = $auto_renew_status_change_date_ms;
        return $this;
    }

    public function getAutoRenewStatusChangeDatePst(): ?DateTimeInterface
    {
        return $this->auto_renew_status_change_date_pst;
    }

    public function setAutoRenewStatusChangeDatePst(?DateTimeInterface $auto_renew_status_change_date_pst): self
    {
        $this->auto_renew_status_change_date_pst = $auto_renew_status_change_date_pst;
        return $this;
    }

    public function getBid(): string
    {
        return $this->bid;
    }

    public function setBid(string $bid): self
    {
        $this->bid = $bid;
        return $this;
    }

    public function getBvrs(): string
    {
        return $this->bvrs;
    }

    public function setBvrs(string $bvrs): self
    {
        $this->bvrs = $bvrs;
        return $this;
    }

    public function getEnvironment(): string
    {
        return $this->environment;
    }

    public function setEnvironment(string $environment): self
    {
        $this->environment = $environment;
        return $this;
    }

    public function getExpirationIntent(): int
    {
        return $this->expiration_intent;
    }

    public function setExpirationIntent(int $expiration_intent): self
    {
        $this->expiration_intent = $expiration_intent;
        return $this;
    }

    public function getNotificationType(): string
    {
        return $this->notification_type;
    }

    public function setNotificationType(string $notification_type): self
    {
        $this->notification_type = $notification_type;
        return $this;
    }

    public function getOriginalTransactionId(): string
    {
        return $this->original_transaction_id;
    }

    public function setOriginalTransactionId(string $original_transaction_id): self
    {
        $this->original_transaction_id = $original_transaction_id;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function isSucceed(): bool
    {
        return in_array($this->notification_type, [
            self::INITIAL_BUY,
            self::DID_RENEW,
        ]);
    }

    public static function getAvailableNotificationTypes(): array
    {
        return [
            self::INITIAL_BUY,
            self::DID_RENEW,
            self::DID_FAIL_TO_RENEW,
            self::CANCEL,
        ];
    }

    public static function getAvailableEnvTypes(): array
    {
        return [
            self::ENV_SANDBOX,
            self::ENV_PROD,
        ];
    }
}