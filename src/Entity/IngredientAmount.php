<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientAmountRepository")
 */
class IngredientAmount
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ingredient", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredient;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cocktail", inversedBy="ingredientAmount")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cocktail;

    public function getId()
    {
        return $this->id;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCocktail(): ?Cocktail
    {
        return $this->cocktail;
    }

    public function setCocktail(?Cocktail $cocktail): self
    {
        $this->cocktail = $cocktail;

        return $this;
    }
}
