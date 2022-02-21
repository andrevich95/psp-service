<?php

namespace App\Providers\Apple;

use App\Providers\AbstractProvider;
use App\Providers\Apple\Form\ResponseBodyV1Form;
use App\Providers\Apple\Form\SubscribeForm;
use App\Providers\Apple\Model\ResponseBodyV1Request;
use App\Providers\Apple\Model\SubscribeRequest;
use App\Providers\Apple\Service\AppleService;
use App\Providers\CommandResponse;
use App\Providers\Interfaces\CommandResultInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AppleProvider extends AbstractProvider
{
    protected AppleService $appleService;
    public function __construct(HttpClientInterface $httpClient, AppleService $appleService)
    {
        parent::__construct($httpClient);
        $this->appleService = $appleService;
    }

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
        $subscription = $this->appleService->createSubscription($request);

        return (new CommandResponse())->setPayload(['subscription_internal_id' => $subscription->getId()]);
    }

    public function notification(ResponseBodyV1Request $request): CommandResultInterface
    {
        $subscription = $this->appleService->updateSubscription($request);

        //TODO: Store transaction

        return (new CommandResponse())->setPayload(['subscription_internal_id' => $subscription->getId()]);
    }
}