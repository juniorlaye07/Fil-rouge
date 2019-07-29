<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PartenaireRepository")
 */
class Partenaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $ninea;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $raisonsocial;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette cage ne doit pas etre vide")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' l'email est invalide.",
     *     checkMX = true
     * )
     */
    private $adresse_mail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Utilisateur", mappedBy="id_partenaire")
     */
    private $utilisateurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comptbank", mappedBy="id_partenaire")
     */
    private $comptbanks;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->comptbanks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNinea(): ?string
    {
        return $this->ninea;
    }

    public function setNinea(string $ninea): self
    {
        $this->ninea = $ninea;

        return $this;
    }

    public function getRaisonsocial(): ?string
    {
        return $this->raisonsocial;
    }

    public function setRaisonsocial(string $raisonsocial): self
    {
        $this->raisonsocial = $raisonsocial;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresse_mail;
    }

    public function setAdresseMail(string $adresse_mail): self
    {
        $this->adresse_mail = $adresse_mail;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->setIdPartenaire($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->removeElement($utilisateur);
            // set the owning side to null (unless already changed)
            if ($utilisateur->getIdPartenaire() === $this) {
                $utilisateur->setIdPartenaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comptbank[]
     */
    public function getComptbanks(): Collection
    {
        return $this->comptbanks;
    }

    public function addComptbank(Comptbank $comptbank): self
    {
        if (!$this->comptbanks->contains($comptbank)) {
            $this->comptbanks[] = $comptbank;
            $comptbank->setIdPartenaire($this);
        }

        return $this;
    }

    public function removeComptbank(Comptbank $comptbank): self
    {
        if ($this->comptbanks->contains($comptbank)) {
            $this->comptbanks->removeElement($comptbank);
            // set the owning side to null (unless already changed)
            if ($comptbank->getIdPartenaire() === $this) {
                $comptbank->setIdPartenaire(null);
            }
        }

        return $this;
    }
}
