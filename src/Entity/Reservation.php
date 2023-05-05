<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 * @ORM\Table(name="reservation")
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name = "idreserv")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Salle")
     * @ORM\JoinColumn(name="idsalle", referencedColumnName="id")
     */
    private $salle;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Association")
     * @ORM\JoinColumn(name="idassociation", referencedColumnName="id")
     */
    private $association;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Personne")
     * @ORM\JoinColumn(name="idpersonne", referencedColumnName="id")
     */
    private $personne;

    /**
     * @ORM\Column(type="datetime")
     * @var string A "d-m-Y" formatted value
     */
    private $datedebut;

    /**
     * @ORM\Column(type="datetime")
     * @var string A "d-m-Y" formatted value
     */
    private $datefin;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @ORM\Column(type="string")
     */
    private $justification;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getJustification()
    {
        return $this->justification;
    }

    public function setJustification($justification): self
    {
        $this->justification = $justification;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        return $this;
    }

    public function getPersonne(): ?Personne
    {
        return $this->personne;
    }

    public function setPersonne(?Personne $personne): self
    {
        $this->personne = $personne;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }
}