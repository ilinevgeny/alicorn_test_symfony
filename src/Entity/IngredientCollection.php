<?php

namespace App\Entity;
use App\Repository\IngredientCollectionRepository;
use Doctrine\ORM\Mapping as ORM;

class IngredientCollection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pizza", name="pizza", inversedBy="IngredientCollection")
     */
    private $pizza;

    public function __construct()
    {
    }

    public function getPizza(): ?Pizza
    {
        return $this->pizza;
    }

    public function setPizza(?Pizza $pizza): self
    {
        $this->pizza = $pizza;

        return $this;
    }


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ingredient", name="ingredient", inversedBy="IngredientCollection")
     */
    private $ingredient;

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

}