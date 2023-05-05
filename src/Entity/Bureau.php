<?php

namespace App\Entity;

use App\Repository\BureauRepository;
use Doctrine\ORM\Mapping as ORM;



/**

 * @ORM\Entity(repositoryClass="App\Repository\BureauRepository")
 * @ORM\Table(name="bureau")

 */
class Bureau extends Salle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Association")
     * @ORM\JoinColumn(name="occupant", referencedColumnName="id")
     */
    private $occupant;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getOccupant()
    {
        return $this->occupant;
    }

    public function setOccupant($occupant): void
    {
        $this->occupant = $occupant;
    }

    public function __toString()
    {
        return $this->getNom();
    }

}

