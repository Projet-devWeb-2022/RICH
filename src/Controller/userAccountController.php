<?php
namespace App\Controller;

use App\Form\EditUserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class userAccountController extends AbstractController
{

    /**
     * @Route("/profile", name="app_profile")
     */
    public function home(): Response
    {
        return $this->render('userAccountPage/userAccount.html.twig');
    }

    /**
     * @Route("/profile/orders", name="app_profile_orders")
     */
    public function orders(): Response
    {
        return $this->render('userAccountPage/userOrders.html.twig');
    }

    /**
     * @Route("/profile/edit", name="app_profile_edit")
     */
    public function editProfile(ManagerRegistry $doctrine,Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditUserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('userAccountPage/editUser.html.twig', [
            'editForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/debug")
     */
    public function debug(): Response
    {
        $object = new \stdClass();
        $object->title = 'Tintin';
        $object->createdAt = new \DateTime();

        dump($object);

        return $this->render('baseUser.html.twig');
    }
}
