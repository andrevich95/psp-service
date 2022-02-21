<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends CommonController
{
    /**
     * @Route("/api/notification/apple/response-body-v1", name="notification_apple_response_body_v1", methods={"POST"})
     */
    public function notification(Request $request): JsonResponse
    {
        $data = $this->post($request, 'payload');

        return $this->json($this->post($request));
    }
}