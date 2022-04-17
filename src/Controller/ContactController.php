<?php

namespace App\Controller;


use App\Form\ContactType;

use App\Service\Mailing\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;


use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mail = new MailService('venant de : '.$form->get('usrMail')->getData() ."\n" .$form->get('msg')->getData(), $form->get('title')->getData(), 'webrich235@gmail.com');
            $mail->sendMail($mailer);
            $this->addFlash('message', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
