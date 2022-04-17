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

        $panierWithData = $this->getCart($session, $packRepository);

        $total = 0;

        foreach ($panierWithData as $item) {
            $totalItem = $item['pack']->getPrice() * $item['quantity'];
            $total += $totalItem;
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

        return $this->redirectToRoute('app_homepage');

    }

    #[Route('/checkout', name: 'checkout')]
    public function checkout(SessionInterface $sess, PackRepository $packRepository, $stripeSK): Response
    {
        $panier = $this->getCart($sess, $packRepository);
        Stripe::setApiKey($stripeSK);
        $total = 0;
        foreach ($panier as $item) {
            $totalItem = $item['pack']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }
        $sess->set('total', $total);
        $apiCart=[];
        foreach ($panier as $item) {
            $apiCart[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item['pack']->getName(),
                    ],
                    'unit_amount' => $item['pack']->getPrice()*100,
                ],
                'quantity' => $item['quantity'],
            ];
        }
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                $apiCart
            ],
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

    public function getTotal(CartService $cartService){
        return $cartService->getTotal();
    }



}
