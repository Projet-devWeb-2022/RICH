<?php

namespace App\Repository;

use App\Entity\VehicleRental;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VehicleRental|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleRental|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleRental[]    findAll()
 * @method VehicleRental[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRentalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleRental::class);
    }

    public function findRentalVehicles($value,$em)
    {
        $conn = $em->getConnection();
        $sql = '
            SELECT * FROM prestation p
            WHERE p.prestationType = :type
           
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['type' => $value]);
        $rentalVehicles = $resultSet->fetchAllAssociative();
        return $rentalVehicles;
    }

}
