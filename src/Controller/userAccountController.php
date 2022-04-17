<?php
namespace App\Controller;

use App\Form\EditPasswordType;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use App\Service\Mailing\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
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
    public function editProfile(Request $request, UserRepository $userRepository)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditUserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $userRepository->updateUser($user);
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
    public function editPassword(Request $request, UserPasswordHasherInterface $userPasswordHasher,  MailerInterface $mailer, UserRepository $userRepository)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditPasswordType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $form->get('password')->getData() === $form->get('confirm')->getData()){
            $userRepository->upgradePassword($user,
                $userPasswordHasher->hashPassword(
                $user,
                $form->get('password')->getData()
            ));

            $mail = new MailService('Votre mot de passe a été modifié avec succès !', 'Modification du mot de passe', $user->getEmail());
            $mail->sendMail($mailer);
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
    public function deleteUser(Request $request, MailerInterface $mailer, UserRepository $userRepository)
    {
        if($request->isMethod('POST')){
            $user = $this->getUser();
            $this->container->get('security.token_storage')->setToken(null);
            $userRepository->deleteUser($user);
            $mail = new MailService('Votre compte a été supprimé de la base de données !', 'Suppression de votre compte', $user->getEmail());
            $mail->sendMail($mailer);
            return $this->redirectToRoute('app_homepage');
        }
        return $this->render('userAccountPage/delete.html.twig');
    }
}
