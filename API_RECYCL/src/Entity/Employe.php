<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeRepository")
 * @ApiResource()
 */
class Employe
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaiss;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEmbauche;

    /**
     * @ORM\Column(type="float")
     */
    private $salaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fonction", inversedBy="employes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $position;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Camion", mappedBy="employes")
     */
    private $camions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tournee", mappedBy="employe")
     */
    private $tournees;

    public function __construct()
    {
        $this->camions = new ArrayCollection();
        $this->tournees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getDateEmbauche(): ?\DateTimeInterface
    {
        return $this->dateEmbauche;
    }

    public function setDateEmbauche(\DateTimeInterface $dateEmbauche): self
    {
        $this->dateEmbauche = $dateEmbauche;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getPosition(): ?Fonction
    {
        return $this->position;
    }

    public function setPosition(?Fonction $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Collection|Camion[]
     */
    public function getCamions(): Collection
    {
        return $this->camions;
    }

    public function addCamion(Camion $camion): self
    {
        if (!$this->camions->contains($camion)) {
            $this->camions[] = $camion;
            $camion->addEmploye($this);
        }

        return $this;
    }

    public function removeCamion(Camion $camion): self
    {
        if ($this->camions->contains($camion)) {
            $this->camions->removeElement($camion);
            $camion->removeEmploye($this);
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
            $tournee->setEmploye($this);
        }

        return $this;
    }

    public function removeTournee(Tournee $tournee): self
    {
        if ($this->tournees->contains($tournee)) {
            $this->tournees->removeElement($tournee);
            // set the owning side to null (unless already changed)
            if ($tournee->getEmploye() === $this) {
                $tournee->setEmploye(null);
            }
        }

        return $this;
    }
}
