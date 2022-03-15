<?php

namespace App\Repository;

use App\Entity\OrderRecap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderRecap|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderRecap|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderRecap[]    findAll()
 * @method OrderRecap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRecapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderRecap::class);
    }

    // /**
    //  * @return OrderRecap[] Returns an array of OrderRecap objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderRecap
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
