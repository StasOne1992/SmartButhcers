<?php

namespace App\Entity;

use App\Repository\NomenclatureTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NomenclatureTypesRepository::class)]
class NomenclatureTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\OneToMany(mappedBy: 'NomenclatureTypes', targetEntity: Nomenclature::class)]
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
            $nomenclature->setNomenclatureType($this);
        }

        return $this;
    }

    public function removeNomenclature(Nomenclature $nomenclature): self
    {
        if ($this->nomenclatures->removeElement($nomenclature)) {
            // set the owning side to null (unless already changed)
            if ($nomenclature->getNomenclatureType() === $this) {
                $nomenclature->setNomenclatureType(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getName() ?: '';
    }
}
