<?php

declare(strict_types=1);

namespace App\Providers\Interfaces;

interface CommandResultInterface
{
    public function isSuccess(): bool;

    public function getPayload(): array;

    public function getErrors(): array;

    public function getStatus(): string;

    public function getStatusCode(): int;

    public function format(): array;

    public function canKeepPolling(): bool;
}
