<?php

namespace App\Controller;


use App\Repository\PackRepository;
use App\Service\Cart\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(SessionInterface $session, PackRepository $packRepository): Response
    {
        //passer au render uniquement le resultat avant de rendre !!!!
        $cartService = new CartService($session, $packRepository);
        $panierWithData = $cartService->getFullCart();
        $total = $cartService->getTotal();

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'items' => $panierWithData,
            'total'=> $total
        ]);
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove($id, SessionInterface $session,PackRepository $packRepository ){

        $cartService = new CartService($session, $packRepository);
        $cartService->remove($id);

        return $this->redirectToRoute('cart');

    }


    public function add($id, CartService $cartService){
        $cartService->add($id);

        return $this->redirectToRoute('cart');
    }
    

    public function getTotal(CartService $cartService){
        return $cartService->getTotal();
    }



}
