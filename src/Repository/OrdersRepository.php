<?php

namespace App\Repository;

use App\Entity\Orders;
use App\Entity\OrderRecap;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @method Orders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orders[]    findAll()
 * @method Orders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orders::class);
    }


    public function createOrder(array $panier, SessionInterface $session, User $user){

        $order = new Orders();
        $orderRecap = new OrderRecap();

        $orderRecap->setBillingAdress($user->getAddress());
        $orderRecap->setTransactionType("Carte");
        $orderRecap->setOrdersRattached($order);

        foreach ($panier as $item) {
            $order->setPack($item['pack']);
        }
        $date = New \DateTime();
        $ref = $user->getName() . $date->format('d-m-Y-H-i');
        $order->setAmmount($session->get('total'));
        $order->setUser($user);
        $order->setOrderRecap($orderRecap);
        $order->setDateOfOrder($date);
        $order->setReference($ref);
        $order->setCreatedAt(new \DateTimeImmutable());
        $order->setUpdatedAt(new \DateTimeImmutable());


        $this->_em->persist($order);
        $this->_em->persist($orderRecap);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    // /**
    //  * @return Order[] Returns an array of Order objects
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
    public function findOneBySomeField($value): ?Order
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
