<?php

namespace App\Controller;

use App\Serializer\FormErrorSerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class CommonController extends AbstractController
{
    protected array $postData = [];
    protected FormErrorSerializerInterface $formErrorSerializer;

    public function __construct(FormErrorSerializerInterface $formErrorSerializer) {
        $this->formErrorSerializer = $formErrorSerializer;
    }

    public function json(mixed $data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        if ($data instanceof FormInterface && $data->isSubmitted()) {
            if ($data->isValid()) {
                $data = $data->getData();
            } else {
                $status = Response::HTTP_UNPROCESSABLE_ENTITY;
                $data = $this->formErrorSerializer->getErrors($data);
            }
        }

        return parent::json($data, $status, $headers, $context);
    }

    public function post(Request $request, $key = null, $defaultValue = null)
    {
        $data = (array)$this->parseRequestBody($request);

        return $key ? ($data[$key] ?? $defaultValue) : $data;
    }

    public function getLoadedForm(Request $request, string $formClass, $entity = null, $clearMissing = true): FormInterface
    {
        if (!is_object($entity)) {
            $entity = is_string($entity) && class_exists($entity) ? new $entity() : null;
        }

        return $this->createForm($formClass, $entity)->submit($this->post($request), $clearMissing);
    }

    private function parseRequestBody(Request $request)
    {
        if (!$this->postData) {
            $this->postData = (array)json_decode($request->getContent(), true) ?? [];
        }

        return $this->postData;
    }
}