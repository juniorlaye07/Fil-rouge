<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\Column(type="integer")
     */
    private $montant;

    /**
     * @ORM\Column(type="integer")
     */
    private $frais;

    /**
     * @ORM\Column(type="integer")
     */
    private $gain;

    /**
     * @ORM\Column(type="integer")
     */
    private $taxetat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomcomplet;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel;

    /**
     * @ORM\Column(type="integer")
     */
    private $CIN;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_envoie;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_retrait;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getFrais(): ?int
    {
        return $this->frais;
    }

    public function setFrais(int $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function getGain(): ?int
    {
        return $this->gain;
    }

    public function setGain(int $gain): self
    {
        $this->gain = $gain;

        return $this;
    }

    public function getTaxetat(): ?int
    {
        return $this->taxetat;
    }

    public function setTaxetat(int $taxetat): self
    {
        $this->taxetat = $taxetat;

        return $this;
    }

    public function getNomcomplet(): ?string
    {
        return $this->nomcomplet;
    }

    public function setNomcomplet(string $nomcomplet): self
    {
        $this->nomcomplet = $nomcomplet;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getCIN(): ?int
    {
        return $this->CIN;
    }

    public function setCIN(int $CIN): self
    {
        $this->CIN = $CIN;

        return $this;
    }

    public function getDateEnvoie(): ?\DateTimeInterface
    {
        return $this->date_envoie;
    }

    public function setDateEnvoie(\DateTimeInterface $date_envoie): self
    {
        $this->date_envoie = $date_envoie;

        return $this;
    }

    public function getDateRetrait(): ?\DateTimeInterface
    {
        return $this->date_retrait;
    }

    public function setDateRetrait(\DateTimeInterface $date_retrait): self
    {
        $this->date_retrait = $date_retrait;

        return $this;
    }
}
