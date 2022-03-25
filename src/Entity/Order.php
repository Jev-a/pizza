<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $orderNr;

    /**
     * @ORM\Column(type="integer")
     */
    private $pizzaId;

    /**
     * @ORM\Column(type="integer")
     */
    private $ingredientId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $queue;

    public function __construct(
        ?int $orderNumber = null,
        ?int $pizzaId = null,
        ?int $ingredientId = null,
        ?int $queue = null
    ) {
        if ($orderNumber !== null) $this->setOrderNr($orderNumber);
        if ($pizzaId !== null) $this->setPizzaId($pizzaId);
        if ($ingredientId !== null) $this->setIngredientId($ingredientId);
        if ($queue !== null) $this->setQueue($queue);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getOrderNr(): ?int
    {
        return $this->orderNr;
    }

    /**
     * @param string $orderNr
     * @return $this
     */
    public function setOrderNr(string $orderNr): self
    {
        $this->orderNr = $orderNr;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPizzaId(): ?int
    {
        return $this->pizzaId;
    }

    /**
     * @param int $pizzaId
     * @return $this
     */
    public function setPizzaId(int $pizzaId): self
    {
        $this->pizzaId = $pizzaId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getIngredientId(): ?int
    {
        return $this->ingredientId;
    }

    /**
     * @param int $ingredientId
     * @return $this
     */
    public function setIngredientId(int $ingredientId): self
    {
        $this->ingredientId = $ingredientId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQueue(): ?int
    {
        return $this->queue;
    }

    /**
     * @param int|null $queue
     * @return $this
     */
    public function setQueue(?int $queue): self
    {
        $this->queue = $queue;

        return $this;
    }
}
