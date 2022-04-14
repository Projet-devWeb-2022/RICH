<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\AdminProfilType;
use App\Form\AdminType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;


class AdminController extends AbstractController
{


    /**
     * @Route("/admin/home", name="home")
     */
    public function home(): Response
    {
        return $this->render('admin/adminHomePage.html.twig');
    }

    /**
     * @Route("/admin/profil")
     */
    public function showProfil(): Response
    {
        return $this->render('admin/adminProfilPage.html.twig');
    }

    #[Route('/admin/profil/edit', name:'editAdminProfil', methods:['GET','POST'])]
    public function updateAdminProfil(Request $request , EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdminProfilType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Profil mis à jour avec succès !'
            );
            return $this->redirectToRoute("home");
        }

        return $this->render('admin/adminProfilPage.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //Users

    /**
     * @Route("/admin/user/all", name="allUsers")
     * @param PersistenceManagerRegistry $em
     * @param $paginator
     * @return Response
     */
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

    #[Route('/admin/user/edit/{id}', name:'adminToUser', methods:['GET','POST'])]
    public function updateRoles(Request $request , EntityManagerInterface $entityManager, int $id ): Response
    {
        $repo = $entityManager->getRepository(User::Class);
        $user =  $repo->find($id);
        $form = $this->createForm(AdminType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();


            $this->addFlash(
                'success',
                'Vehicule mis à jour avec succès !'
            );
            return $this->redirectToRoute("allUsers");
        }

        return $this->render('admin/Users/userToAdmin.html.twig', [
            'form' => $form->createView()
        ]);
    }




    #[Route('/admin/user/delete/{id}' ,name:'deleteUser', methods:['GET','DELETE'])]
    public function deleteUser($id, ManagerRegistry $doctrine): Response
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
        return $this->redirectToRoute("allUsers");
    }
}
