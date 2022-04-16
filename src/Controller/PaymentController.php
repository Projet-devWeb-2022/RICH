<?php

namespace App\Controller;

use App\Entity\OrderRecap;
use App\Entity\Orders;
use App\Repository\PackRepository;
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
    public function successUrl(PackRepository $packRepository, ManagerRegistry $doctrine, SessionInterface $session, MailerInterface $mailer): Response
    {
        $panier = $this->getCart($session, $packRepository);

        $user=$this->getUser();
        $order = new Orders();
        $orderRecap = new OrderRecap();

        $orderRecap->setBillingAdress($user->getAddress());
        $orderRecap->setTransactionType("Carte");
        $orderRecap->setOrdersRattached($order);

        foreach ($panier as $item) {
            $order->setPack($item['pack']);
        }
        $date = New \DateTime();
        $ref = $user->getName() . $date->format('d-m-Y-H-i');
        $order->setAmmount($session->get('total'));
        $order->setUser($user);
        $order->setOrderRecap($orderRecap);
        $order->setDateOfOrder($date);
        $order->setReference($ref);
        $order->setCreatedAt(new \DateTimeImmutable());
        $order->setUpdatedAt(new \DateTimeImmutable());

        $em = $doctrine->getManager();
        $em->persist($order);
        $em->persist($orderRecap);
        $em->persist($user);
        $em->flush();

        $date = new \DateTime();
        $email = (new Email())
            ->from('webrich235@gmail.com')
            ->to($this->getUser()->getEmail())

            ->subject('Votre commande du '. $date->format("D-d-M-Y"))
            ->text('Votre commande a bien été confirmée ! Vous retrouverez vos informations de paiement dans l\'onglet commandes de votre espace personnel');


        $mailer->send($email);
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
