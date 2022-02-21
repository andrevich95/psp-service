<?php

namespace App\Providers\Apple\Model;

use DateTimeInterface;

class SubscribeRequest
{
    private string $product_id;

    public function getProductId(): string
    {
        return $this->product_id;
    }

    public function setProductId(string $product_id): self
    {
        $this->product_id = $product_id;
        return $this;
    }
}