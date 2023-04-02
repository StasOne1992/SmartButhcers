<?php

namespace App\Entity;

use App\Repository\ProductionRecipeContentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductionRecipeContentRepository::class)]
class ProductionRecipeContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'productionRecipeContents')]
    private ?ProductionRecipeStructure $ProductionRecipeSection = null;

    #[ORM\ManyToOne(inversedBy: 'productionRecipeContents')]
    private ?Nomenclature $Nomenclature = null;

    #[ORM\Column]
    private ?float $PostionArgument = null;

    #[ORM\Column(length: 255)]
    private ?string $PostionFormula = null;

    #[ORM\ManyToMany(targetEntity: ProductionRecipe::class, inversedBy: 'productionRecipeContents')]
    private Collection $ProductionRecipeID;

    public function __construct()
    {
        $this->ProductionRecipeID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductionRecipeSection(): ?ProductionRecipeStructure
    {
        return $this->ProductionRecipeSection;
    }

    public function setProductionRecipeSection(?ProductionRecipeStructure $ProductionRecipeSection): self
    {
        $this->ProductionRecipeSection = $ProductionRecipeSection;

        return $this;
    }

    public function getNomenclature(): ?Nomenclature
    {
        return $this->Nomenclature;
    }

    public function setNomenclature(?Nomenclature $Nomenclature): self
    {
        $this->Nomenclature = $Nomenclature;

        return $this;
    }

    public function getPostionArgument(): ?float
    {
        return $this->PostionArgument;
    }

    public function setPostionArgument(float $PostionArgument): self
    {
        $this->PostionArgument = $PostionArgument;

        return $this;
    }

    public function getPostionFormula(): ?string
    {
        return $this->PostionFormula;
    }

    public function setPostionFormula(string $PostionFormula): self
    {
        $this->PostionFormula = $PostionFormula;

        return $this;
    }

    /**
     * @return Collection<int, ProductionRecipe>
     */
    public function getProductionRecipeID(): Collection
    {
        return $this->ProductionRecipeID;
    }

    public function addProductionRecipeID(ProductionRecipe $productionRecipeID): self
    {
        if (!$this->ProductionRecipeID->contains($productionRecipeID)) {
            $this->ProductionRecipeID->add($productionRecipeID);
        }

        return $this;
    }

    public function removeProductionRecipeID(ProductionRecipe $productionRecipeID): self
    {
        $this->ProductionRecipeID->removeElement($productionRecipeID);

        return $this;
    }
    public function __toString()
    {
        return $this->getStructureName() ?: '';
    }
}
