<?php

namespace App\Entity;

use App\Repository\ProductionRecipeArgumentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductionRecipeArgumentsRepository::class)]
class ProductionRecipeArguments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $RecipeArgumentGUID = null;

    #[ORM\ManyToOne(inversedBy: 'productionRecipeArguments')]
    private ?ProductionRecipe $RecipeID = null;

    #[ORM\Column(length: 255)]
    private ?string $RecipeArgumentID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getRecipeArgumentGUID(): ?string
    {
        return $this->RecipeArgumentGUID;
    }

    public function setRecipeArgumentGUID(string $RecipeArgumentGUID): self
    {
        $this->RecipeArgumentGUID = $RecipeArgumentGUID;

        return $this;
    }

    public function getRecipeID(): ?ProductionRecipe
    {
        return $this->RecipeID;
    }

    public function setRecipeID(?ProductionRecipe $RecipeID): self
    {
        $this->RecipeID = $RecipeID;

        return $this;
    }

    public function getRecipeArgumentID(): ?string
    {
        return $this->RecipeArgumentID;
    }

    public function setRecipeArgumentID(string $RecipeArgumentID): self
    {
        $this->RecipeArgumentID = $RecipeArgumentID;

        return $this;
    }
}
