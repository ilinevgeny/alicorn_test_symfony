<?php

namespace App\Entity;

use App\Repository\IngredientsCollectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientsCollectionRepository::class)]
class IngredientsCollection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Pizza::class, inversedBy: 'ingredientsCollections')]
    #[ORM\JoinColumn(nullable: false)]
    private $pizza_id;

    #[ORM\ManyToOne(targetEntity: Ingredient::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $ingredient_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPizzaId(): ?Pizza
    {
        return $this->pizza_id;
    }

    public function setPizzaId(?Pizza $pizza_id): self
    {
        $this->pizza_id = $pizza_id;

        return $this;
    }

    public function getIngredientId(): ?Ingredient
    {
        return $this->ingredient_id;
    }

    public function setIngredientId(?Ingredient $ingredient_id): self
    {
        $this->ingredient_id = $ingredient_id;

        return $this;
    }
}
