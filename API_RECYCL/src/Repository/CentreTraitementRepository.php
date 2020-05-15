<?php

namespace App\Repository;

use App\Entity\CentreTraitement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CentreTraitement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CentreTraitement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CentreTraitement[]    findAll()
 * @method CentreTraitement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CentreTraitementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CentreTraitement::class);
    }

    // /**
    //  * @return CentreTraitement[] Returns an array of CentreTraitement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CentreTraitement
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
