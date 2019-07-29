<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DepotArgentRepository")
 */
class DepotArgent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_depot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Comptbank", inversedBy="depotArgents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $comptbank;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->date_depot;
    }

    public function setDateDepot(\DateTimeInterface $date_depot): self
    {
        $this->date_depot = $date_depot;

        return $this;
    }

    public function getComptbank(): ?Comptbank
    {
        return $this->comptbank;
    }

    public function setComptbank(?Comptbank $comptbank): self
    {
        $this->comptbank = $comptbank;

        return $this;
    }
}
