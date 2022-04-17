<?php


namespace App\Controller\Admin;


use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserController extends AbstractController
{
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