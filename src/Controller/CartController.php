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
        //$panierWithData = $cartService->getFullCart();
        //$total = $cartService->getTotal();

        $panier = $session->get('panier', []);

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

    public function add($id, CartService $cartService){
        $cartService->add($id);

        return $this->redirectToRoute('app_destinationpage_index');
    }

    public function remove($id, CartService $cartService){
        $cartService->remove($id);
        return $this->redirectToRoute('app_destinationpage_index');

    }

    public function getTotal(CartService $cartService){
        return $cartService->getTotal();
    }



}
