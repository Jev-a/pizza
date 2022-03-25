<?php

namespace App\Services;

use App\Entity\Order;
use App\Repository\OrderRepository;

class OrderService
{
    /** @var OrderRepository */
    protected $orderRepository;

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Save and return order data
     *
     * @param array $elements
     * @return array
     */
    public function saveOrder(array $elements): array
    {
        if (empty($elements)) {
            return [];
        }

        $orderNr = $this->getNextOrderNumber();
        foreach ($elements as $element) {
            $modelOrder = new Order(
                $orderNr,
                (int)$element['pizzaId'],
                (int)$element['ingredientId'],
                (int)$element['ingredientQueue']
            );

            $this->orderRepository->add($modelOrder);
        }

        return $this->preparationOrder($orderNr);
    }

    /**
     * return next number for order
     * @return int
     */
    private function getNextOrderNumber(): int
    {
        $orderNr = 0;
        $lastOrder = $this->orderRepository->getLastOrder();
        if ($lastOrder !== null) {
            $orderNr = $lastOrder->getOrderNr();
        }

        return ++$orderNr;
    }

    /**
     * return order data with sort ingredients after save function
     *
     * @param int $orderNr
     * @return array
     */
    private function preparationOrder(int $orderNr): array
    {
        $orderElements = $this->orderRepository->getOrder($orderNr);

        $order = [
            'orderNr' => '',
            'pizzaName' => '',
            'ingredients' => [],
            'totalPrice' => 0.0,
        ];

        for ($j = 0; $j < count($orderElements) - 1; $j++) {
            for ($i = 0; $i < count($orderElements) - $j - 1; $i++) {
                if ($orderElements[$i]['queue'] > $orderElements[$i + 1]['queue']) {
                    $tmp_var = $orderElements[$i + 1];
                    $orderElements[$i + 1] = $orderElements[$i];
                    $orderElements[$i] = $tmp_var;
                }
            }
        }

        foreach ($orderElements as $orderElement) {
            $order['ingredients'][] = $orderElement['title'];
            $order['totalPrice'] += (float)$orderElement['price'];
        }

        $lastOrderElement = $orderElements[count($orderElements)-1];
        if (!empty($lastOrderElement)) {
            $order['orderNr'] = $lastOrderElement['orderNr'];
            $order['pizzaName'] = $lastOrderElement['name'];
            $order['totalPrice'] = number_format(
                (float)$order['totalPrice'] * 1.5,
                2
            );
        }

        return $order;
    }

}