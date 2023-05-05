<?php

namespace App\Repository;

use App\Entity\Bureau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bureau|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bureau|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bureau[]    findAll()
 * @method Bureau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BureauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bureau::class);
    }

}
