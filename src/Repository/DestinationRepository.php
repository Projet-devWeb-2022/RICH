<?php

namespace App\Repository;

use App\Entity\Destination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Destination|null find($id, $lockMode = null, $lockVersion = null)
 * @method Destination|null findOneBy(array $criteria, array $orderBy = null)
 * @method Destination[]    findAll()
 * @method Destination[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DestinationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Destination::class);
    }

    public function findDestinations($value,$em)
    {
        $conn = $em->getConnection();
        $sql = '
            SELECT * FROM destination p
            WHERE p.id > :type
           
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['type' => $value]);
        $destinations = $resultSet->fetchAllAssociative();
        return $destinations;
    }
    public function travelByCity()
    {
        $reponse = EntityRepository::createQueryBuilder('u')
            ->orderBy('u.city', 'ASC');
        return $reponse;
    }
}
