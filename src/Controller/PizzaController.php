<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PizzaController extends AbstractController
{
    /**
     * @param PizzaRepository $pizzaRepository
     * @return Response
     */
    public function list(PizzaRepository $pizzaRepository): Response
    {
        $pizzas = $pizzaRepository->findAll();

        return $this->render('menu.html.twig', ['pizzas' => $pizzas]);
    }

    /**
     * @param PizzaRepository $pizzaRepository
     * @param int $id
     * @return Response
     */
    public function pizza(PizzaRepository $pizzaRepository, int $id): Response
    {
        $pizza = $pizzaRepository->findOneBy(['id' => $id]);
        if ($pizza !== null) {
            $pizza->setTotalPrice();
        }

        return $this->render('edit_pizza.html.twig', ['pizza' => $pizza]);
    }
}
