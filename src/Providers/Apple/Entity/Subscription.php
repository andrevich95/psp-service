<?php

namespace App\Providers\Apple\Entity;

use App\Providers\Apple\Repository\SubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_CANCELLED = 'cancelled';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $subscription_id;

    #[ORM\Column(type: 'string', length: 40)]
    private $status;

    #[ORM\Column(type: 'date')]
    private $auto_renew_status_change_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

    public function setSubscriptionId($subscription_id): self
    {
        $this->subscription_id = $subscription_id;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAutoRenewStatusChangeDate(): ?\DateTimeInterface
    {
        return $this->auto_renew_status_change_date;
    }

    public function setAutoRenewStatusChangeDate(\DateTimeInterface $auto_renew_status_change_date): self
    {
        $this->auto_renew_status_change_date = $auto_renew_status_change_date;

        return $this;
    }
}
