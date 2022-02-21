<?php

namespace App\Providers\Apple;

use App\Providers\AbstractProvider;
use App\Providers\Apple\Form\ResponseBodyV1Form;
use App\Providers\Apple\Form\SubscribeForm;
use App\Providers\Apple\Model\ResponseBodyV1Request;
use App\Providers\Apple\Model\SubscribeRequest;
use App\Providers\CommandResponse;
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

    protected function getCommandConfig(): array
    {
        return [
            'subscribe' => [
                'form' => SubscribeForm::class,
                'callable' => [$this, 'subscribe']
            ],
            'notification' => [
                'form' => ResponseBodyV1Form::class,
                'callable' => [$this, 'notification']
            ],
        ];
    }

    public function subscribe(SubscribeRequest $request): CommandResultInterface
    {
        return (new CommandResponse())->setPayload(['number' => $request->getNumber()]);
    }

    public function notification(ResponseBodyV1Request $request): CommandResultInterface
    {
        return (new CommandResponse())->setPayload(['success' => true]);
    }
}