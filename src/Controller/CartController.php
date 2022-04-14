<?php

namespace App\Controller;

use App\Repository\DestinationRepository;
use App\Repository\PackRepository;
use App\Service\Cart\CartService;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(SessionInterface $session, PackRepository $packRepository, DestinationRepository $destinationRepository): Response
    {
        //passer au render uniquement le resultat avant de rendre !!!!
        //$panierWithData = $cartService->getFullCart();
        //$total = $cartService->getTotal();

        $panier = $session->get('panier', []);
        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'pack' => $packRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'items' => $panierWithData,
        ]);
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove($id, SessionInterface $session){
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('cart');

    }

    #[Route('/checkout', name: 'checkout')]
    public function checkout($stripeSK): Response
    {
        Stripe::setApiKey($stripeSK);
        //$total = $this->getTotal();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Votre commande RICH',
                    ],
                    'unit_amount' => 200,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
        return $this->redirect($session->url, 303);
    }

    public function add($id, CartService $cartService){
        $cartService->add($id);

        return $this->redirectToRoute('cart');
    }


    public function removeService($id, CartService $cartService){
        $cartService->remove($id);
        return $this->redirectToRoute('cart');

    }

    public function getTotal(CartService $cartService){
        return $cartService->getTotal();
    }



}
