<?php

namespace App\Entity;

use App\Repository\BatimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BatimentRepository::class)
 * @ORM\Table(name="batiment")
 */
class Batiment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etage", mappedBy="batiment")
     */
    private $lesEtages;

    public function __construct()
    {
        $this->lesEtages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Etage[]
     */
    public function getLesEtages(): Collection
    {
        return $this->lesEtages;
    }

    public function addLesEtage(Etage $lesEtage): self
    {
        if (!$this->lesEtages->contains($lesEtage)) {
            $this->lesEtages[] = $lesEtage;
            $lesEtage->setBatiment($this);
        }

        return $this;
    }

    public function removeLesEtage(Etage $lesEtage): self
    {
        if ($this->lesEtages->removeElement($lesEtage)) {
            // set the owning side to null (unless already changed)
            if ($lesEtage->getBatiment() === $this) {
                $lesEtage->setBatiment(null);
            }
        }

        return $this;
    }
}
