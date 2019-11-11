<?php

namespace App\Repository;

use App\Entity\TestBase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TestBase|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestBase|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestBase[]    findAll()
 * @method TestBase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestBaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestBase::class);
    }

    // /**
    //  * @return TestBase[] Returns an array of TestBase objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TestBase
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
