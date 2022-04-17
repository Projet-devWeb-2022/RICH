<?php

namespace App\Controller;

use App\Entity\OrderRecap;
use App\Entity\Orders;
use App\Repository\OrdersRepository;
use App\Repository\PackRepository;
use App\Service\MailService;
use Doctrine\Persistence\ManagerRegistry;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{

    #[Route('/payment/success', name: 'success_url')]
    public function successUrl(OrdersRepository $ordersRepository, PackRepository $packRepository, ManagerRegistry $doctrine, SessionInterface $session, MailerInterface $mailer): Response
    {
        $panier = $this->getCart($session, $packRepository);
        $ordersRepository->createOrder($panier, $session, $doctrine );
        $mailcontent = 'Votre commande a bien été confirmée ! Vous retrouverez vos informations de paiement dans l\'onglet commandes de votre espace personnel';
        $mail = new MailService($mailcontent, 'Votre commande du '. (new \DateTime())->format("d M Y"), $this->getUser()->getEmail());
        $mail->sendMail($mailer);
        $session->set('panier', []);
        return $this->render('payment/success.html.twig', []);
    }

    #[Route('/payment/cancel', name: 'cancel_url')]
    public function cancelUrl(): Response
    {
        return $this->render('payment/cancel.html.twig', []);
    }

    public function getCart(SessionInterface $session,PackRepository $packRepository){
        $panier = $session->get('panier', []);
        $panierWithData = [];
        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'pack' => $packRepository->find($id),
                'quantity' => $quantity
            ];
        }
        return $panierWithData;
    }
}
