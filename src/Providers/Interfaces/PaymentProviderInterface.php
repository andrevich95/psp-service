<?php

declare(strict_types=1);

namespace App\Providers\Interfaces;

interface PaymentProviderInterface
{
    /** To initialize some variables **/
    public function init(): void;

    /** To identify the provider **/
    public function getId(): string;

    /**
     * Get symfony form to validate request
     *
     * @param string $command
     * @return string
     */
    public function getFormByCommand(string $command): string;

    /**
     * Run request
     *
     * @param string $command
     * @param object $dto
     * @return CommandResultInterface
     */
    public function run(string $command, object $dto): CommandResultInterface;
}
