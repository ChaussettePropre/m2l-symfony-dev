<?php

namespace App\Entity;

use App\Repository\AssociationRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;

/**
 * @ORM\Entity(repositoryClass=AssociationRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"association" = "Association", "ligue" = "Ligue", "comite" = "Comite"})
 * @ORM\Table(name="association")
 */
class Association
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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


    /**
     * @ORM\Column(type="string")
     */
    private $nom;

    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }



    /**
     * @ORM\Column(type="string")
     */
    private $adresse;

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse): void
    {
        $this->adresse = $adresse;
    }



    /**
     * @ORM\Column(type="integer")
     */
    private $cddepartement;

    public function getCddepartement(): ?int
    {
        return $this->cddepartement;
    }

    /**
     * @param mixed $cddepartement
     */
    public function setCddepartement($cddepartement): void
    {
        $this->cddepartement = $cddepartement;
    }


    /**
     * @ORM\Column(type="string")
     */
    private $tel;

    public function getTel(): ?string
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel): void
    {
        $this->tel = $tel;
    }




    /**
     * @ORM\Column(type="string")
     */
    private $email;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }






    public function __toString(): string
    {
        return $this->getNom();
    }


}
