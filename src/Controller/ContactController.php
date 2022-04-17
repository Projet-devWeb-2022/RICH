<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
                ->from('webrich235@gmail.com')
                ->to('webrich235@gmail.com')

                ->subject($form->get('title')->getData())
                ->text('venant de : '.$form->get('usrMail')->getData() ."\n" .$form->get('msg')->getData());

            $mailer->send($email);
            $this->addFlash('message', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
