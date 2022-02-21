<?php

namespace App\Providers\Apple;

use App\Providers\AbstractProvider;
use App\Providers\Interfaces\CommandResultInterface;

class AppleProvider extends AbstractProvider
{
    public function init(): void
    {
        // TODO: Implement init() method.
    }

    public function getId(): string
    {
        return 'apple';
    }

    public function run(string $command, object $dto): CommandResultInterface
    {
        // TODO: Implement run() method.
    }

    protected function getCommandConfig(): array
    {
        return [

            'payment-reference' => [
                'form' => '',
                'callable' => [$this, 'getPaymentReference']
            ],
        ];
    }
}