<?php

namespace App\Entity;

use App\Repository\SalleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalleRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"salle" = "Salle", "bureau" = "Bureau", "sallereservable" = "Sallereservable"})
 * @ORM\Table(name="salle")
 */

class Salle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="salle_idsalle_seq")
     * @ORM\Column(type="integer",name="id")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etage")
     * @ORM\JoinColumn(name="situation", referencedColumnName="id")
     */
    private $etage;

    /**
     * @ORM\Column(type="string")
     */
    private $situation;

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSituation(): ?string
    {
        return $this->situation;
    }

    public function setSituation(string $situation): self
    {
        $this->situation = $situation;

        return $this;
    }

    public function getEtage(): ?Etage
    {
        return $this->etage;
    }

    public function setEtage(?Etage $etage): self
    {
        $this->etage = $etage;

        return $this;
    }


    public function __toString()
    {
        return $this->getNom();
    }
}
