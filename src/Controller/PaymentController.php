<?php

namespace App\Controller;

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{

    #[Route('/payment/success', name: 'success_url')]
    public function successUrl(MailerInterface $mailer): Response
    {
        $date = new \DateTime();
        $email = (new Email())
            ->from('webrich235@gmail.com')
            ->to($this->getUser()->getEmail())

            ->subject('Votre commande du '. $date->format("D-d-M-Y"))
            ->text('Votre commande a bien été confirmée ! Vous retrouverez vos informations de paiement dans l\'onglet commandes de votre espace personnel');


        $mailer->send($email);
        return $this->render('payment/success.html.twig', []);
    }


    #[Route('/payment/cancel', name: 'cancel_url')]
    public function cancelUrl(): Response
    {
        return $this->render('payment/cancel.html.twig', []);
    }


}
