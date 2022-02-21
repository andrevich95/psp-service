<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SoftwareController extends AbstractController
{
    /**
     * @Route("/api/software", name="software_info", methods={"GET"})
     */
    public function software(): JsonResponse
    {
        return $this->json([
            'version' => '0.1',
        ]);
    }
}