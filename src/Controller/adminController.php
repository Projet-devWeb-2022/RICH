<?php


namespace App\Controller;


use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;


class adminController extends AbstractController
{

    //Admin Managemennt
    /**
     * @Route("/admin/home")
     */
    public function test(): Response
    {
        return $this->render('admin/adminHomePage.html.twig');
    }

    /**
     * @Route("/admin/profil")
     */
    public function test2(): Response
    {
        return $this->render('admin/adminProfilPage.html.twig');
    }

    //Users

    /**
     * @Route("/admin/user/all")
     * @param PersistenceManagerRegistry $em
     * @param $paginator
     * @return Response
     */
    public function show(PersistenceManagerRegistry $em, PaginatorInterface $paginator, Request $req): Response
    {
        $repo = $em->getRepository(User::Class);
        $users =  $repo->findAll();
        $users = $paginator->paginate(
            $users, // Requête contenant les données à paginer (ici nos articles)
            $req->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );
        return $this->render('admin/Users/adminAllUsersPages.html.twig',
            ['controller_name' => 'AdminController',
            'users' => $users
        ]);

    }


    #[Route('/admin/user/delete/{id}' ,'user.delete', methods:['GET','DELETE'])]
    public function adminDeleteUser($id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $user = $em->getRepository(User::class)->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }
        $em->remove($user);
        $em->flush();
        $this->addFlash('success', 'Suppression réussie');
        return $this->redirect("/admin/user/all");
    }
}
