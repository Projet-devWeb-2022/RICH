<?php

namespace App\Service\Admin;

use App\Form\AdminProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminService
{
    protected $request;
    protected $entityManager;
    protected $em;
    protected $paginator;


    public function __construct(Request $request , EntityManagerInterface $entityManager, PersistenceManagerRegistry $em, PaginatorInterface $paginator,){
        $this->request = $request;
        $this->entityManager = $entityManager;
        $this->em = $em;
        $this->paginator = $paginator;
    }


}