<?php

namespace App\Providers\Apple\Entity;

use App\Providers\Apple\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $auto_renew_adam_id;

    #[ORM\Column(type: 'string', length: 255)]
    private $auto_renew_product_id;

    #[ORM\Column(type: 'boolean')]
    private $auto_renew_status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutoRenewAdamId(): ?int
    {
        return $this->auto_renew_adam_id;
    }

    public function setAutoRenewAdamId(int $auto_renew_adam_id): self
    {
        $this->auto_renew_adam_id = $auto_renew_adam_id;

        return $this;
    }

    public function getAutoRenewProductId(): ?string
    {
        return $this->auto_renew_product_id;
    }

    public function setAutoRenewProductId(string $auto_renew_product_id): self
    {
        $this->auto_renew_product_id = $auto_renew_product_id;

        return $this;
    }

    public function getAutoRenewStatus(): ?bool
    {
        return $this->auto_renew_status;
    }

    public function setAutoRenewStatus(bool $auto_renew_status): self
    {
        $this->auto_renew_status = $auto_renew_status;

        return $this;
    }
}
