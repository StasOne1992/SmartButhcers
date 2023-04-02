<?php

namespace App\Entity;

use App\Repository\NomenclatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NomenclatureRepository::class)]
class Nomenclature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'nomenclature')]
    private ?NomenclatureTypes $NomenclatureTypes = null;

    #[ORM\ManyToOne(inversedBy: 'nomenclatures')]
    private ?ClassifierOKEI $Unit = null;

    #[ORM\Column(length: 255)]
    private ?string $NomenclatureName = null;

    #[ORM\Column(length: 255)]
    private ?string $NomenclatureArticul = null;

    #[ORM\Column(length: 255)]
    private ?string $NomenclatureGUID = null;

    #[ORM\OneToMany(mappedBy: 'Nomenclature', targetEntity: ProductionRecipeContent::class)]
    private Collection $productionRecipeContents;

    public function __construct()
    {
        $this->productionRecipeContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomenclatureTypes(): ?NomenclatureTypes
    {
        return $this->NomenclatureTypes;
    }

    public function setNomenclatureTypes(?NomenclatureTypes $NomenclatureTypes): self
    {
        $this->NomenclatureTypes = $NomenclatureTypes;

        return $this;
    }

    public function getUnit(): ?ClassifierOKEI
    {
        return $this->Unit;
    }

    public function setUnit(?ClassifierOKEI $Unit): self
    {
        $this->Unit = $Unit;

        return $this;
    }

    public function getNomenclatureName(): ?string
    {
        return $this->NomenclatureName;
    }

    public function setNomenclatureName(string $NomenclatureName): self
    {
        $this->NomenclatureName = $NomenclatureName;

        return $this;
    }

    public function getNomenclatureArticul(): ?string
    {
        return $this->NomenclatureArticul;
    }

    public function setNomenclatureArticul(string $NomenclatureArticul): self
    {
        $this->NomenclatureArticul = $NomenclatureArticul;

        return $this;
    }

    public function getNomenclatureGUID(): ?string
    {
        return $this->NomenclatureGUID;
    }

    public function setNomenclatureGUID(string $NomenclatureGUID): self
    {
        $this->NomenclatureGUID = $NomenclatureGUID;

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
            $productionRecipeContent->setNomenclature($this);
        }

        return $this;
    }

    public function removeProductionRecipeContent(ProductionRecipeContent $productionRecipeContent): self
    {
        if ($this->productionRecipeContents->removeElement($productionRecipeContent)) {
            // set the owning side to null (unless already changed)
            if ($productionRecipeContent->getNomenclature() === $this) {
                $productionRecipeContent->setNomenclature(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNomenclatureName() ?: '';
    }
}
