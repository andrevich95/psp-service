<?php

namespace App\Providers\Apple\Model;

use DateTimeInterface;

class SubscribeRequest
{
    private int $number;

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;
        return $this;
    }
}