<?php


namespace App\Controller\Admin;


use App\Entity\User;
use App\Form\AdminType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RolesController extends AbstractController
{

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
}