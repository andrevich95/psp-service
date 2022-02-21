<?php

namespace App\Controller;

use App\Providers\PaymentProviderFactory;
use App\Serializer\FormErrorSerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends CommonController
{
    use PaymentProviderTrait;

    private PaymentProviderFactory $paymentManager;

    public function __construct(FormErrorSerializerInterface $formErrorSerializer, PaymentProviderFactory $paymentManager)
    {
        parent::__construct($formErrorSerializer);
        $this->paymentManager = $paymentManager;
    }

    /**
     * @Route("/api/notification/apple/response-body-v1", name="notification_apple_response_body_v1", methods={"POST"})
     */
    public function notification(Request $request): JsonResponse
    {
        $paymentProvider = $this->getPaymentProvider('apple');
        $payload = $this->post($request, 'payload') ?? [];

        $formType = $paymentProvider->getFormByCommand('notification');

        $form = $this->createForm($formType, null)->submit($payload, true);

        if (!$form->isValid()) {
            return $this->json($form);
        }

        $result = $paymentProvider->run('notification', $form->getData());

        return $this->json($result->getPayload());
    }
}