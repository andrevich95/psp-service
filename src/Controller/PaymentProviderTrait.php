<?php

namespace App\Controller;

use App\Providers\Interfaces\PaymentProviderInterface;

trait PaymentProviderTrait
{
    private function getPaymentProvider(string $code): PaymentProviderInterface
    {
        return $this->paymentManager->getPaymentProvider($code);
    }
}