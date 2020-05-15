<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseClientRepository")
 * @ApiResource()
 */
class EntrepriseClient
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
    private $raisonSociale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $norueentr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rueentr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cpostalentr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vileentr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $notel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Demande", mappedBy="entreprise")
     */
    private $demandes;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raisonSociale;
    }

    public function setRaisonSociale(string $raisonSociale): self
    {
        $this->raisonSociale = $raisonSociale;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNorueentr(): ?string
    {
        return $this->norueentr;
    }

    public function setNorueentr(?string $norueentr): self
    {
        $this->norueentr = $norueentr;

        return $this;
    }

    public function getRueentr(): ?string
    {
        return $this->rueentr;
    }

    public function setRueentr(string $rueentr): self
    {
        $this->rueentr = $rueentr;

        return $this;
    }

    public function getCpostalentr(): ?string
    {
        return $this->cpostalentr;
    }

    public function setCpostalentr(string $cpostalentr): self
    {
        $this->cpostalentr = $cpostalentr;

        return $this;
    }

    public function getVileentr(): ?string
    {
        return $this->vileentr;
    }

    public function setVileentr(string $vileentr): self
    {
        $this->vileentr = $vileentr;

        return $this;
    }

    public function getNotel(): ?string
    {
        return $this->notel;
    }

    public function setNotel(string $notel): self
    {
        $this->notel = $notel;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

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
            $demande->setEntreprise($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->contains($demande)) {
            $this->demandes->removeElement($demande);
            // set the owning side to null (unless already changed)
            if ($demande->getEntreprise() === $this) {
                $demande->setEntreprise(null);
            }
        }

        return $this;
    }
}
