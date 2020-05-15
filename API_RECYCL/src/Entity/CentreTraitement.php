<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CentreTraitementRepository")
 * @ApiResource()
 */
class CentreTraitement
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
    private $nomCentre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $noRueCentre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rueCentre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cPostalCentre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villeCentre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeDechet", inversedBy="centreTraitements")
     */
    private $typeDechet;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tournee", mappedBy="centreTraitements")
     */
    private $tournees;

    public function __construct()
    {
        $this->typeDechet = new ArrayCollection();
        $this->tournees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCentre(): ?string
    {
        return $this->nomCentre;
    }

    public function setNomCentre(string $nomCentre): self
    {
        $this->nomCentre = $nomCentre;

        return $this;
    }

    public function getNoRueCentre(): ?string
    {
        return $this->noRueCentre;
    }

    public function setNoRueCentre(?string $noRueCentre): self
    {
        $this->noRueCentre = $noRueCentre;

        return $this;
    }

    public function getRueCentre(): ?string
    {
        return $this->rueCentre;
    }

    public function setRueCentre(string $rueCentre): self
    {
        $this->rueCentre = $rueCentre;

        return $this;
    }

    public function getCPostalCentre(): ?string
    {
        return $this->cPostalCentre;
    }

    public function setCPostalCentre(string $cPostalCentre): self
    {
        $this->cPostalCentre = $cPostalCentre;

        return $this;
    }

    public function getVilleCentre(): ?string
    {
        return $this->villeCentre;
    }

    public function setVilleCentre(string $villeCentre): self
    {
        $this->villeCentre = $villeCentre;

        return $this;
    }

    /**
     * @return Collection|TypeDechet[]
     */
    public function getTypeDechet(): Collection
    {
        return $this->typeDechet;
    }

    public function addTypeDechet(TypeDechet $typeDechet): self
    {
        if (!$this->typeDechet->contains($typeDechet)) {
            $this->typeDechet[] = $typeDechet;
        }

        return $this;
    }

    public function removeTypeDechet(TypeDechet $typeDechet): self
    {
        if ($this->typeDechet->contains($typeDechet)) {
            $this->typeDechet->removeElement($typeDechet);
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
            $tournee->addCentreTraitement($this);
        }

        return $this;
    }

    public function removeTournee(Tournee $tournee): self
    {
        if ($this->tournees->contains($tournee)) {
            $this->tournees->removeElement($tournee);
            $tournee->removeCentreTraitement($this);
        }

        return $this;
    }
}
