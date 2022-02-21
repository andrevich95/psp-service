<?php

declare(strict_types=1);

namespace App\Providers;

use App\Providers\Exception\CommandNotSupportedException;
use App\Providers\Interfaces\CommandResultInterface;
use App\Providers\Interfaces\PaymentProviderInterface;

abstract class AbstractProvider implements PaymentProviderInterface
{
    /** Get config with command received from client side **/
    abstract protected function getCommandConfig(): array;

    /**
     * @throws CommandNotSupportedException
     */
    public function run(string $command, object $dto): CommandResultInterface
    {
        foreach ($this->getCommandConfig() as $cmd => $config) {
            if ($cmd === $command) {
                return $config['callable']($dto);
            }
        }

        throw new CommandNotSupportedException('Command ' . $command . ' not supported by ' . $this->getId());
    }

    /**
     * @throws CommandNotSupportedException
     */
    public function getFormByCommand(string $command): string
    {
        foreach ($this->getCommandConfig() as $cmd => $config) {
            if ($cmd === $command) {
                return $config['form'];
            }
        }

        throw new CommandNotSupportedException('Form for ' . $command . ' in ' . $this->getId() . ' not configured yet');
    }
}
