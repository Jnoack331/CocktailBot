<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PortRepository")
 */
class Port
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $pin;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ingredient", inversedBy="port", cascade={"persist", "remove"})
     */
    private $Ingredient;

    public function getId()
    {
        return $this->id;
    }

    public function getPin(): ?int
    {
        return $this->pin;
    }

    public function setPin(int $pin): self
    {
        $this->pin = $pin;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->Ingredient;
    }

    public function setIngredient(?Ingredient $Ingredient): self
    {
        $this->Ingredient = $Ingredient;

        return $this;
    }
}
