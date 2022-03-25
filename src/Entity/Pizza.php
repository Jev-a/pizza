<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pizzes")
 * @ORM\Entity(repositoryClass="App\Repository\PizzaRepository")
 */
class Pizza
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", inversedBy="pizzes", fetch="EAGER")
     * @ORM\JoinTable(name="ingredient_pizza")
     */
    private $ingredients;

    /**
     * @var float
     */
    private $totalPrice;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    /**
     * @param $ingredients
     * @return void
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return float|null
     */
    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    /**
     * @return void
     */
    public function setTotalPrice()
    {
        $totalPrice = 0.00;
        foreach ($this->ingredients->toArray() as $ingredient) {
            $totalPrice += (float)$ingredient->getPrice();
        }
        $totalPrice = $totalPrice * 1.5;

        $this->totalPrice = $totalPrice;
    }
}
