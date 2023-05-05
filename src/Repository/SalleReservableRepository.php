<?php

namespace App\Repository;

use App\Entity\Sallereservable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sallereservable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sallereservable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sallereservable[]    findAll()
 * @method Sallereservable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalleReservableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sallereservable::class);
    }

    public function findByCategorie($categorie)
    {
        $qb = $this->createQueryBuilder('s')
            ->where('s.categorie = :categorie')
            ->setParameter('categorie', $categorie)
            ->orderBy('s.id');

        $query = $qb->getQuery();

        return $query->execute();
    }

    // /**
    //  * @return Sallereservable[] Returns an array of Sallereservable objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sallereservable
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
