<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CamionRepository")
 * @ApiResource()
 */
class Camion
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
    private $noImmatric;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAchat;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Employe", inversedBy="camions")
     */
    private $employes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Modele", inversedBy="camions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modele;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tournee", mappedBy="camion")
     */
    private $tournees;

    public function __construct()
    {
        $this->employes = new ArrayCollection();
        $this->tournees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoImmatric(): ?string
    {
        return $this->noImmatric;
    }

    public function setNoImmatric(string $noImmatric): self
    {
        $this->noImmatric = $noImmatric;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    /**
     * @return Collection|Employe[]
     */
    public function getEmployes(): Collection
    {
        return $this->employes;
    }

    public function addEmploye(Employe $employe): self
    {
        if (!$this->employes->contains($employe)) {
            $this->employes[] = $employe;
        }

        return $this;
    }

    public function removeEmploye(Employe $employe): self
    {
        if ($this->employes->contains($employe)) {
            $this->employes->removeElement($employe);
        }

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

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
            $tournee->setCamion($this);
        }

        return $this;
    }

    public function removeTournee(Tournee $tournee): self
    {
        if ($this->tournees->contains($tournee)) {
            $this->tournees->removeElement($tournee);
            // set the owning side to null (unless already changed)
            if ($tournee->getCamion() === $this) {
                $tournee->setCamion(null);
            }
        }

        return $this;
    }
}
