<?php

declare(strict_types=1);

namespace App\Serializer;

use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;

class FormErrorSerializer implements FormErrorSerializerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getErrors(FormInterface $form): array
    {
        $formErrors = [];

        /** @var FormError $error */
        foreach ($form->getErrors(true, true) as $error) {
            $formErrors[] = [
                'field' => $error->getOrigin()->getName(),
                'message' => $error->getMessage(),
            ];
        }

        $this->logger->error('VALIDATION_ERROR ' . json_encode($formErrors, JSON_PRETTY_PRINT));

        return [
            'status' => 'validation-error',
            'payload' => [
                'message' => empty($formErrors) ? null : $formErrors[0]['field'] . ': ' . $formErrors[0]['message'],
            ],
        ];
    }
}
