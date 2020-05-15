<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DemandeRepository")
 * @ApiResource()
 */
class Demande
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
    private $dateDemande;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnlevement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EntrepriseClient", inversedBy="demandes")
     */
    private $entreprise;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeDechet", mappedBy="demandes")
     */
    private $typeDechets;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tournee", mappedBy="demandes")
     */
    private $tournees;

    public function __construct()
    {
        $this->typeDechets = new ArrayCollection();
        $this->tournees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getDateEnlevement(): ?\DateTimeInterface
    {
        return $this->dateEnlevement;
    }

    public function setDateEnlevement(?\DateTimeInterface $dateEnlevement): self
    {
        $this->dateEnlevement = $dateEnlevement;

        return $this;
    }

    public function getEntreprise(): ?EntrepriseClient
    {
        return $this->entreprise;
    }

    public function setEntreprise(?EntrepriseClient $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return Collection|TypeDechet[]
     */
    public function getTypeDechets(): Collection
    {
        return $this->typeDechets;
    }

    public function addTypeDechet(TypeDechet $typeDechet): self
    {
        if (!$this->typeDechets->contains($typeDechet)) {
            $this->typeDechets[] = $typeDechet;
            $typeDechet->addDemande($this);
        }

        return $this;
    }

    public function removeTypeDechet(TypeDechet $typeDechet): self
    {
        if ($this->typeDechets->contains($typeDechet)) {
            $this->typeDechets->removeElement($typeDechet);
            $typeDechet->removeDemande($this);
        }

        return $this;
    }

    /**
     * @return Collection|Tournee[]
     */
    public function getTournees(): Collection
    {
        return $this->tournees;
    }

    public function addTournee(Tournee $tournee): self
    {
        if (!$this->tournees->contains($tournee)) {
            $this->tournees[] = $tournee;
            $tournee->addDemande($this);
        }

        return $this;
    }

    public function removeTournee(Tournee $tournee): self
    {
        if ($this->tournees->contains($tournee)) {
            $this->tournees->removeElement($tournee);
            $tournee->removeDemande($this);
        }

        return $this;
    }
}
