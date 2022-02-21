<?php

declare(strict_types=1);

namespace App\Serializer;

use Symfony\Component\Form\FormInterface;

interface FormErrorSerializerInterface
{
    public function getErrors(FormInterface $form): array;
}
