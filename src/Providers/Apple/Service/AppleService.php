<?php

namespace App\Providers\Apple\Service;

use App\Providers\Apple\Entity\Subscription;
use App\Providers\Apple\Model\ResponseBodyV1Request;
use App\Providers\Apple\Model\SubscribeRequest;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class AppleService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createSubscription(SubscribeRequest $request): Subscription
    {
        $subscription = new Subscription();

        $subscription->setStatus(Subscription::STATUS_ACTIVE)
            ->setAutoRenewStatusChangeDate(new DateTime())
            ->setSubscriptionId($request->getProductId());

        $this->entityManager->persist($subscription);
        $this->entityManager->flush();

        return $subscription;
    }

    public function updateSubscription(ResponseBodyV1Request $request): Subscription
    {
        /** @var Subscription $subscription */
        $subscription = $this->entityManager->getRepository(Subscription::class)->findBy(['subscription_id' => $request->getAutoRenewProductId()]);

        $subscription->setStatus($request->isSucceed() ? Subscription::STATUS_ACTIVE : Subscription::STATUS_CANCELLED);
        $this->entityManager->flush();

        return $subscription;
    }
}