<?php

declare(strict_types=1);

namespace App\Providers;

use App\Providers\Interfaces\CommandResultInterface;

class CommandResponse implements CommandResultInterface
{
    private array $payload = [];

    private array $errors = [];

    private string $status = 'undefined';

    private ?string $redirectUrl = null;

    private int $statusCode = 200;

    private bool $canKeepPolling = true;

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function isSuccess(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setPayload(array $payload): self
    {
        $this->payload = $payload;

        return $this;
    }

    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function addError(string $message, ?string $category = null): self
    {
        $this->errors[] = $message;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function stopPolling(): void
    {
        $this->canKeepPolling = false;
    }

    public function format(): array
    {
        return [
            'status' => $this->getStatus(),
            'payload' => empty($this->errors) ? $this->getPayload() : ['message' => $this->errors[0]],
        ];
    }

    public function canKeepPolling(): bool
    {
        return $this->canKeepPolling;
    }

    public function getRedirectUrl(): ?string
    {
        return $this->redirectUrl;
    }

    public function setRedirectUrl(?string $redirectUrl): self
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }
}
