<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CocktailRepository")
 */
class Cocktail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", inversedBy="cocktails")
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IngredientAmount", mappedBy="cocktail", orphanRemoval=true)
     */
    private $ingredientAmount;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->ingredientAmount = new ArrayCollection();
    }

    public function getId()
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
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
        }

        return $this;
    }

    /**
     * @return Collection|IngredientAmount[]
     */
    public function getIngredientAmount(): Collection
    {
        return $this->ingredientAmount;
    }

    public function addIngredientAmount(IngredientAmount $ingredientAmount): self
    {
        if (!$this->ingredientAmount->contains($ingredientAmount)) {
            $this->ingredientAmount[] = $ingredientAmount;
            $ingredientAmount->setCocktail($this);
        }

        return $this;
    }

    public function removeIngredientAmount(IngredientAmount $ingredientAmount): self
    {
        if ($this->ingredientAmount->contains($ingredientAmount)) {
            $this->ingredientAmount->removeElement($ingredientAmount);
            // set the owning side to null (unless already changed)
            if ($ingredientAmount->getCocktail() === $this) {
                $ingredientAmount->setCocktail(null);
            }
        }

        return $this;
    }
}
