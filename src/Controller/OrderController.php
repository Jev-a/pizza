<?php

namespace App\Controller;

use App\Services\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends AbstractController
{
    /**
     * @param OrderService $orderService
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function create(OrderService $orderService, Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirect('/');
        }
        try {
            $orderElements = $request->request->get('elements');
            $order = $orderService->saveOrder($orderElements ?? []);

            return $this->json(['order' => $order]);
        } catch (\Throwable $throwable) {
            return $this->json([
                'error' => $throwable->getMessage(),
            ]);
        }
    }

}