<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**

 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 * @ORM\Table(name="categorie")

 */

class Categorie

{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="categorie_id_seq")
     * @ORM\Column(type="integer",name="id")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $libelle;

    /**
     * @ORM\Column(type="float")
     */
    private $tarif;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sallereservable", mappedBy="id")
     */
    private $lesSalles;


    public function __construct()
    {
        $this->lesSalles = new ArrayCollection();
    }

    /**
     * @return Collection|Sallereservable[]
     */
    public function getLesSalles(): Collection
    {
        return $this->lesSalles;
    }

    /**
     * @param mixed $lesSalles
     */
    public function setLesSalles($lesSalles): void
    {
        $this->lesSalles = $lesSalles;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function addLesSalle(Sallereservable $lesSalle): self
    {
        if (!$this->lesSalles->contains($lesSalle)) {
            $this->lesSalles[] = $lesSalle;
            $lesSalle->setId($this);
        }

        return $this;
    }

    public function removeLesSalle(Sallereservable $lesSalle): self
    {
        if ($this->lesSalles->removeElement($lesSalle)) {
            // set the owning side to null (unless already changed)
            if ($lesSalle->getId() === $this) {
                $lesSalle->setId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return  $this->getLibelle();
    }

}


