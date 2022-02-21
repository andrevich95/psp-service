<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends CommonController
{
    /**
     * @Route("/api/notification/apple", name="notification_apple", methods={"POST"})
     */
    public function executeCommand(Request $request): JsonResponse
    {
        $data = $this->post($request, 'payload');

        return $this->json($this->post($request));
    }
}