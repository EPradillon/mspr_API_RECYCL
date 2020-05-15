<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeDechetRepository")
 * @ApiResource()
 */
class TypeDechet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nivDanger;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomtypedechet;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Demande", inversedBy="typeDechets")
     */
    private $demandes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CentreTraitement", mappedBy="typeDechet")
     */
    private $centreTraitements;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
        $this->centreTraitements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNivDanger(): ?string
    {
        return $this->nivDanger;
    }

    public function setNivDanger(string $nivDanger): self
    {
        $this->nivDanger = $nivDanger;

        return $this;
    }

    public function getNomtypedechet(): ?string
    {
        return $this->nomtypedechet;
    }

    public function setNomtypedechet(string $nomtypedechet): self
    {
        $this->nomtypedechet = $nomtypedechet;

        return $this;
    }

    /**
     * @return Collection|Demande[]
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->contains($demande)) {
            $this->demandes->removeElement($demande);
        }

        return $this;
    }

    /**
     * @return Collection|CentreTraitement[]
     */
    public function getCentreTraitements(): Collection
    {
        return $this->centreTraitements;
    }

    public function addCentreTraitement(CentreTraitement $centreTraitement): self
    {
        if (!$this->centreTraitements->contains($centreTraitement)) {
            $this->centreTraitements[] = $centreTraitement;
            $centreTraitement->addTypeDechet($this);
        }

        return $this;
    }

    public function removeCentreTraitement(CentreTraitement $centreTraitement): self
    {
        if ($this->centreTraitements->contains($centreTraitement)) {
            $this->centreTraitements->removeElement($centreTraitement);
            $centreTraitement->removeTypeDechet($this);
        }

        return $this;
    }
}
