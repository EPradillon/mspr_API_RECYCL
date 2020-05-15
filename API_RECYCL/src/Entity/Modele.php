<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModeleRepository")
 * @ApiResource()
 */
class Modele
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
    private $nomModele;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Marque", inversedBy="modeles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Camion", mappedBy="modele")
     */
    private $camions;

    public function __construct()
    {
        $this->camions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomModele(): ?string
    {
        return $this->nomModele;
    }

    public function setNomModele(string $nomModele): self
    {
        $this->nomModele = $nomModele;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

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
            $camion->setModele($this);
        }

        return $this;
    }

    public function removeCamion(Camion $camion): self
    {
        if ($this->camions->contains($camion)) {
            $this->camions->removeElement($camion);
            // set the owning side to null (unless already changed)
            if ($camion->getModele() === $this) {
                $camion->setModele(null);
            }
        }

        return $this;
    }
}
