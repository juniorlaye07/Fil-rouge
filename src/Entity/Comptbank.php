<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ComptbankRepository")
 */
class Comptbank
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @UniqueEntity(fields={"numcompte"},message="Veillez vérifier votre numéro de compte")
     */
    private $numcompte;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $solde;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DepotArgent", mappedBy="comptbank")
     */
    private $depotArgents;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="comptbanks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_partenaire;

    public function __construct()
    {
        $this->depotArgents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumcompte(): ?int
    {
        return $this->numcompte;
    }

    public function setNumcompte(int $numcompte): self
    {
        $this->numcompte = $numcompte;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(?int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * @return Collection|DepotArgent[]
     */
    public function getDepotArgents(): Collection
    {
        return $this->depotArgents;
    }

    public function addDepotArgent(DepotArgent $depotArgent): self
    {
        if (!$this->depotArgents->contains($depotArgent)) {
            $this->depotArgents[] = $depotArgent;
            $depotArgent->setComptbank($this);
        }

        return $this;
    }

    public function removeDepotArgent(DepotArgent $depotArgent): self
    {
        if ($this->depotArgents->contains($depotArgent)) {
            $this->depotArgents->removeElement($depotArgent);
            // set the owning side to null (unless already changed)
            if ($depotArgent->getComptbank() === $this) {
                $depotArgent->setComptbank(null);
            }
        }

        return $this;
    }

    public function getIdPartenaire(): ?Partenaire
    {
        return $this->id_partenaire;
    }

    public function setIdPartenaire(?Partenaire $id_partenaire): self
    {
        $this->id_partenaire = $id_partenaire;

        return $this;
    }
}
