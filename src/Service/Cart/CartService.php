<?php

namespace App\Service\Cart;

use App\Repository\DestinationRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService {

    protected $session;
    protected $destinationRepository;

    public function __construct(SessionInterface $session, DestinationRepository $destinationRepository){
        $this->session = $session;
        $this->destinationRepository = $destinationRepository;
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

    }

    public function getFullCart() : array {
        $panier = $this->session->get('panier', []);

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $this->destinationRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $panierWithData;

    }

    public function getTotal() : float {
        return 2.5;
    }
}