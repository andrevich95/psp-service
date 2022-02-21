<?php

namespace App\Controller;

use App\Providers\Interfaces\PaymentProviderInterface;
use App\Providers\PaymentProviderFactory;
use App\Serializer\FormErrorSerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandController extends CommonController
{
    private PaymentProviderFactory $paymentManager;

    public function __construct(FormErrorSerializerInterface $formErrorSerializer, PaymentProviderFactory $paymentManager)
    {
        parent::__construct($formErrorSerializer);
        $this->paymentManager = $paymentManager;
    }

    /**
     * @Route("/api/execute-command", name="execute_command", methods={"POST"})
     */
    public function executeCommand(Request $request): JsonResponse
    {
        $paymentProvider = $this->getPaymentProvider($this->post($request, 'psp', ''));
        $command = $this->post($request, 'command') ?? null;
        $payload = $this->post($request, 'payload') ?? [];

        $formType = $paymentProvider->getFormByCommand($command);

        $form = $this->createForm($formType, null)->submit($this->post($request), true);

        if (!$form->isValid()) {
            return $this->json($form);
        }

        $result = $paymentProvider->run($command, $form->getData());

        return $this->json($result->format(), $result->getStatusCode());
    }

    private function getPaymentProvider(string $code): PaymentProviderInterface
    {
        return $this->paymentManager->getPaymentProvider($code);
    }
}