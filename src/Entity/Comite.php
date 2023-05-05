<?php

namespace App\Entity;

use App\Repository\LigueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComiteRepository::class)
 * @ORM\Table(name="comite")
 */
class Comite extends Association
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ligue")
     * @ORM\JoinColumn(name="idliguetravail", referencedColumnName="id")
     */
    private $idLigue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLigue(): ?Ligue
    {
        return $this->idLigue;
    }

    public function setIdLigue(?Ligue $idLigue): self
    {
        $this->idLigue = $idLigue;

        return $this;
    }
}
