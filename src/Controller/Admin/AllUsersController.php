<?php


namespace App\Controller\Admin;


use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllUsersController extends  AbstractController
{
    /**
     * @Route("/admin/user/all", name="allUsers") */
    public function showAllUsers(PersistenceManagerRegistry $em, PaginatorInterface $paginator, Request $req): Response
    {
        $repo = $em->getRepository(User::Class);
        $users =  $repo->findAll();

        $users = $paginator->paginate(
            $users,
            $req->query->getInt('page', 1),
            10
        );
        return $this->render('admin/Users/adminAllUsersPages.html.twig',
            ['controller_name' => 'AdminController',
                'users' => $users
            ]);
    }
}