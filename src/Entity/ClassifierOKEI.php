<?php

namespace App\Entity;

use App\Repository\ClassifierOKEIRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassifierOKEIRepository::class)]
class ClassifierOKEI
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $ShortName = null;

    #[ORM\Column]
    private ?int $PositionKey = null;

    #[ORM\Column]
    private ?int $GroupID = null;

    #[ORM\Column(length: 255)]
    private ?string $GroupName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $SectionName = null;

    #[ORM\OneToMany(mappedBy: 'Unit', targetEntity: Nomenclature::class)]
    private Collection $nomenclatures;

    public function __construct()
    {
        $this->nomenclatures = new ArrayCollection();
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

    public function getShortName(): ?string
    {
        return $this->ShortName;
    }

    public function setShortName(string $ShortName): self
    {
        $this->ShortName = $ShortName;

        return $this;
    }

    public function getPositionKey(): ?int
    {
        return $this->PositionKey;
    }

    public function setPositionKey(int $PositionKey): self
    {
        $this->PositionKey = $PositionKey;

        return $this;
    }

    public function getGroupID(): ?int
    {
        return $this->GroupID;
    }

    public function setGroupID(int $GroupID): self
    {
        $this->GroupID = $GroupID;

        return $this;
    }

    public function getGroupName(): ?string
    {
        return $this->GroupName;
    }

    public function setGroupName(string $GroupName): self
    {
        $this->GroupName = $GroupName;

        return $this;
    }

    public function getSectionName(): ?string
    {
        return $this->SectionName;
    }

    public function setSectionName(string $SectionName): self
    {
        $this->SectionName = $SectionName;

        return $this;
    }

    /**
     * @return Collection<int, Nomenclature>
     */
    public function getNomenclatures(): Collection
    {
        return $this->nomenclatures;
    }

    public function addNomenclature(Nomenclature $nomenclature): self
    {
        if (!$this->nomenclatures->contains($nomenclature)) {
            $this->nomenclatures->add($nomenclature);
            $nomenclature->setUnit($this);
        }

        return $this;
    }

    public function removeNomenclature(Nomenclature $nomenclature): self
    {
        if ($this->nomenclatures->removeElement($nomenclature)) {
            // set the owning side to null (unless already changed)
            if ($nomenclature->getUnit() === $this) {
                $nomenclature->setUnit(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getName() ?: '';
    }
}
