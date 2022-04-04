<?php
namespace App\Controller;

use App\Form\EditPasswordType;
use App\Form\EditUserType;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
     * @Route("/profile/editpwd", name="app_password_edit")
     */
    public function editPassword(ManagerRegistry $doctrine,Request $request, UserPasswordHasherInterface $userPasswordHasher,  MailerInterface $mailer)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditPasswordType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $form->get('password')->getData() === $form->get('confirm')->getData()){
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                $user,
                $form->get('password')->getData()
            ));
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            $email = (new Email())
                ->from('webrich235@gmail.com')
                ->to($user->getEmail())

                ->subject('Modification du mot de passe')
                ->text('Votre mot de passe a été modifié avec succès !');


            $mailer->send($email);

            $this->addFlash('message', 'Mot de passe mis à jour');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('userAccountPage/editPassword.html.twig', [
            'editForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profile/delete", name="app_delete_user")
     */
    public function deleteUser(ManagerRegistry $doctrine, Request $request, MailerInterface $mailer)
    {

        if($request->isMethod('POST')){
            $user = $this->getUser();
            $this->container->get('security.token_storage')->setToken(null);
            $em = $doctrine->getManager();
            $em->remove($user);
            $em->flush();

            $email = (new Email())
                ->from('webrich235@gmail.com')
                ->to($user->getEmail())

                ->subject('Suppression de votre compte')
                ->text('Votre compte a été supprimé de la base de données !');


            $mailer->send($email);

            return $this->redirectToRoute('app_homepage');
        }
        return $this->render('userAccountPage/delete.html.twig');
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
