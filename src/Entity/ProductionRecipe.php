<?php

namespace App\Entity;

use App\Repository\ProductionRecipeRepository;
use App\Repository\ProductionRecipeContentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductionRecipeRepository::class)]
class ProductionRecipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $RecipeName = null;

    #[ORM\ManyToOne(inversedBy: 'productionRecipes')]
    private ?ProductionType $ProductionType = null;

    #[ORM\OneToMany(mappedBy: 'RecipeID', targetEntity: ProductionRecipeArguments::class)]
    private Collection $productionRecipeArguments;

    #[ORM\OneToMany(mappedBy: 'ProductionRecipeID', targetEntity: ProductionRecipeStructure::class)]
    private Collection $productionRecipeStructures;

    #[ORM\ManyToMany(targetEntity: ProductionRecipeContent::class, mappedBy: 'ProductionRecipeID')]
    private Collection $productionRecipeContents;

    public function __construct()
    {
        $this->productionRecipeArguments = new ArrayCollection();
        $this->productionRecipeStructures = new ArrayCollection();
        $this->productionRecipeContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipeName(): ?string
    {
        return $this->RecipeName;
    }

    public function setRecipeName(string $RecipeName): self
    {
        $this->RecipeName = $RecipeName;

        return $this;
    }

    public function getProductionType(): ?ProductionType
    {
        return $this->ProductionType;
    }

    public function setProductionType(?ProductionType $ProductionType): self
    {
        $this->ProductionType = $ProductionType;

        return $this;
    }

    /**
     * @return Collection<int, ProductionRecipeArguments>
     */
    public function getProductionRecipeArguments(): Collection
    {
        return $this->productionRecipeArguments;
    }

    public function addProductionRecipeArgument(ProductionRecipeArguments $productionRecipeArgument): self
    {
        if (!$this->productionRecipeArguments->contains($productionRecipeArgument)) {
            $this->productionRecipeArguments->add($productionRecipeArgument);
            $productionRecipeArgument->setRecipeID($this);
        }

        return $this;
    }

    public function removeProductionRecipeArgument(ProductionRecipeArguments $productionRecipeArgument): self
    {
        if ($this->productionRecipeArguments->removeElement($productionRecipeArgument)) {
            // set the owning side to null (unless already changed)
            if ($productionRecipeArgument->getRecipeID() === $this) {
                $productionRecipeArgument->setRecipeID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductionRecipeStructure>
     */
    public function getProductionRecipeStructures(): Collection
    {
        return $this->productionRecipeStructures;
    }

    public function addProductionRecipeStructure(ProductionRecipeStructure $productionRecipeStructure): self
    {
        if (!$this->productionRecipeStructures->contains($productionRecipeStructure)) {
            $this->productionRecipeStructures->add($productionRecipeStructure);
            $productionRecipeStructure->setProductionRecipeID($this);
        }

        return $this;
    }

    public function removeProductionRecipeStructure(ProductionRecipeStructure $productionRecipeStructure): self
    {
        if ($this->productionRecipeStructures->removeElement($productionRecipeStructure)) {
            // set the owning side to null (unless already changed)
            if ($productionRecipeStructure->getProductionRecipeID() === $this) {
                $productionRecipeStructure->setProductionRecipeID(null);
            }
        }

        return $this;
    }




    public function __toString()
    {
        return $this->getRecipeName() ?: '';
    }

    /**
     * @return Collection<int, ProductionRecipeContent>
     */
    public function getProductionRecipeContents(): Collection
    {
        return $this->productionRecipeContents;
    }

    public function addProductionRecipeContent(ProductionRecipeContent $productionRecipeContent): self
    {
        if (!$this->productionRecipeContents->contains($productionRecipeContent)) {
            $this->productionRecipeContents->add($productionRecipeContent);
            $productionRecipeContent->addProductionRecipeID($this);
        }

        return $this;
    }

    public function removeProductionRecipeContent(ProductionRecipeContent $productionRecipeContent): self
    {
        if ($this->productionRecipeContents->removeElement($productionRecipeContent)) {
            $productionRecipeContent->removeProductionRecipeID($this);
        }

        return $this;
    }
}
