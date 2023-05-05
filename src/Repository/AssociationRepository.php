<?php

namespace App\Repository;

use App\Entity\Association;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Association|null find($id, $lockMode = null, $lockVersion = null)
 * @method Association|null findOneBy(array $criteria, array $orderBy = null)
 * @method Association[]    findAll()
 * @method Association[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Association::class);
    }

    private function assocsByUtilisateur($utilisateur):array{
        $conn = $this->getEntityManager()->getConnection();
        $assocSQl = '
            SELECT t0.id FROM association t0
            INNER JOIN travail t1 ON t0.id=t1.idAssociation
            INNER JOIN personne t2 ON t1.idPersonne=t2.id
            INNER JOIN utilisateur t3 ON t2.id=t3.id
            WHERE t3.pseudonyme= :utilisateur
            ';
        $assocs = $conn->prepare($assocSQl);
        $assocs->execute(['utilisateur' => $utilisateur]);
        return $assocs->fetchAllAssociative();
    }

    public function modif_autorise($utilisateur, $idAssoc):bool{
        $bool = false;
        $assocs = $this->assocsByUtilisateur($utilisateur);
        if(isset($assocs[0])){
            if (in_array($idAssoc, $assocs[0])) {
                $bool = true;
            }
        }
        return $bool;
    }
    // /**
    //  * @return Association[] Returns an array of Association objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Association
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
