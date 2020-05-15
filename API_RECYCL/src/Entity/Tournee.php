<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TourneeRepository")
 * @ApiResource()
 */
class Tournee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTournee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Camion", inversedBy="tournees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $camion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="tournees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employe;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CentreTraitement", inversedBy="tournees")
     */
    private $centreTraitements;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Demande", inversedBy="tournees")
     */
    private $demandes;

    public function __construct()
    {
        $this->centreTraitements = new ArrayCollection();
        $this->demandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTournee(): ?\DateTimeInterface
    {
        return $this->dateTournee;
    }

    public function setDateTournee(\DateTimeInterface $dateTournee): self
    {
        $this->dateTournee = $dateTournee;

        return $this;
    }

    public function getCamion(): ?Camion
    {
        return $this->camion;
    }

    public function setCamion(?Camion $camion): self
    {
        $this->camion = $camion;

        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

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
        }

        return $this;
    }

    public function removeCentreTraitement(CentreTraitement $centreTraitement): self
    {
        if ($this->centreTraitements->contains($centreTraitement)) {
            $this->centreTraitements->removeElement($centreTraitement);
        }

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
}
