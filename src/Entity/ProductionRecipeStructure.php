<?php

namespace App\Entity;

use App\Repository\ProductionRecipeStructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductionRecipeStructureRepository::class)]
class ProductionRecipeStructure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $StructureName = null;

    #[ORM\Column]
    private ?int $StructureOrdering = null;

    #[ORM\OneToMany(mappedBy: 'ProductionRecipeSection', targetEntity: ProductionRecipeContent::class)]
    private Collection $productionRecipeContents;

    #[ORM\ManyToOne(inversedBy: 'productionRecipeStructures')]
    private ?ProductionRecipe $ProductionRecipeID = null;

    public function __construct()
    {
        $this->productionRecipeContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStructureName(): ?string
    {
        return $this->StructureName;
    }

    public function setStructureName(string $StructureName): self
    {
        $this->StructureName = $StructureName;

        return $this;
    }

    public function getStructureOrdering(): ?int
    {
        return $this->StructureOrdering;
    }

    public function setStructureOrdering(int $StructureOrdering): self
    {
        $this->StructureOrdering = $StructureOrdering;

        return $this;
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
            $productionRecipeContent->setProductionRecipeSection($this);
        }

        return $this;
    }

    public function removeProductionRecipeContent(ProductionRecipeContent $productionRecipeContent): self
    {
        if ($this->productionRecipeContents->removeElement($productionRecipeContent)) {
            // set the owning side to null (unless already changed)
            if ($productionRecipeContent->getProductionRecipeSection() === $this) {
                $productionRecipeContent->setProductionRecipeSection(null);
            }
        }

        return $this;
    }

    public function getProductionRecipeID(): ?ProductionRecipe
    {
        return $this->ProductionRecipeID;
    }

    public function setProductionRecipeID(?ProductionRecipe $ProductionRecipeID): self
    {
        $this->ProductionRecipeID = $ProductionRecipeID;

        return $this;
    }
    public function __toString()
    {
        return $this->getStructureName() ?: '';
    }
}
