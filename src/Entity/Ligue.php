<?php

namespace App\Entity;

use App\Repository\LigueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LigueRepository::class)
 * @ORM\Table(name="ligue")
 */
class Ligue extends Association
{


}
