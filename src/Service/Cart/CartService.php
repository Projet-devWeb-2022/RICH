<?php

namespace App\Service\Cart;

use App\Repository\DestinationRepository;
use App\Repository\PackRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService {

    protected $session;
    protected $packRepository;

    public function __construct(SessionInterface $session, PackRepository $packRepository){
        $this->session = $session;
        $this->packRepository = $packRepository;
    }


    public function add(int $id){
        $panier = $this->session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);
    }


    public function remove(int $id){

        $panier = $this->session->get('panier', []);

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        $this->session->set('panier', $panier);

    }

    public function getFullCart() : array {
        $panier = $this->session->get('panier', []);

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $this->packRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $panierWithData;

    }

    public function getTotal() : float {
        $total = 0.0 ;

        $panierWithData = $this->getFullCart();

        foreach ($panierWithData as $item) {
            $totalItem = $item['product']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }
        return $total;
    }
}