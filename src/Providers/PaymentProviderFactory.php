<?php

declare(strict_types=1);

namespace App\Providers;

use App\Providers\Apple\AppleProvider;
use App\Providers\Exception\InvalidServiceException;
use App\Providers\Interfaces\PaymentProviderInterface;

class PaymentProviderFactory
{
    private AppleProvider $appleProvider;

    public function __construct(
        AppleProvider $appleProvider
    ) {
        $this->appleProvider = $appleProvider;
    }

    public function getPaymentProvider(string $id): PaymentProviderInterface
    {
        foreach ($this->getProviders() as $service) {
            if ($service->getId() === $id) {
                $service->init();

                return $service;
            }
        }

        throw new InvalidServiceException('Payment service ' . $id . ' doesnt exists');
    }

    /**
     * @return PaymentProviderInterface[]
     */
    public function getProviders(): array
    {
        return [
            $this->appleProvider,
            // ... Add new services here
        ];
    }
}
