<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalleReservableRepository")
 * @ORM\Table(name="sallereservable")
 */

class Sallereservable extends Salle

{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sallereservable_id_seq")
     * @ORM\Column(type="integer",name="id")
     */
    protected $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie" , inversedBy="lesSalles")
     * @ORM\JoinColumn(name="idcat", referencedColumnName="id")
     */
    private $categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function __toString(): string
    {
        return  $this->getNom();
    }
}
