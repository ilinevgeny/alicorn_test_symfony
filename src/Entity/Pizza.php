<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    #[ORM\OneToMany(mappedBy: 'pizza_id', targetEntity: IngredientsCollection::class, orphanRemoval: true)]
    private $ingredientsCollections;
    
    public function __construct()
    {
        $this->ingredientsCollections = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, IngredientsCollection>
     */
    public function getIngredientsCollections(): Collection
    {
        return $this->ingredientsCollections;
    }

    public function addIngredientsCollection(IngredientsCollection $ingredientsCollection): self
    {
        if (!$this->ingredientsCollections->contains($ingredientsCollection)) {
            $this->ingredientsCollections[] = $ingredientsCollection;
            $ingredientsCollection->setPizzaId($this);
        }

        return $this;
    }

    public function removeIngredientsCollection(IngredientsCollection $ingredientsCollection): self
    {
        if ($this->ingredientsCollections->removeElement($ingredientsCollection)) {
            // set the owning side to null (unless already changed)
            if ($ingredientsCollection->getPizzaId() === $this) {
                $ingredientsCollection->setPizzaId(null);
            }
        }

        return $this;
    }
}
