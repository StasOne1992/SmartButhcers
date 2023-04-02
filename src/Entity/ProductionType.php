<?php

namespace App\Entity;

use App\Repository\ProductionTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductionTypeRepository::class)]
class ProductionType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\OneToMany(mappedBy: 'ProductionType', targetEntity: ProductionRecipe::class)]
    private Collection $productionRecipes;

    public function __construct()
    {
        $this->productionRecipes = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ProductionRecipe>
     */
    public function getProductionRecipes(): Collection
    {
        return $this->productionRecipes;
    }

    public function addProductionRecipe(ProductionRecipe $productionRecipe): self
    {
        if (!$this->productionRecipes->contains($productionRecipe)) {
            $this->productionRecipes->add($productionRecipe);
            $productionRecipe->setProductionType($this);
        }

        return $this;
    }

    public function removeProductionRecipe(ProductionRecipe $productionRecipe): self
    {
        if ($this->productionRecipes->removeElement($productionRecipe)) {
            // set the owning side to null (unless already changed)
            if ($productionRecipe->getProductionType() === $this) {
                $productionRecipe->setProductionType(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getName() ?: '';
    }
}
