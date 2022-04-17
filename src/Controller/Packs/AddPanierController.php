<?php


namespace App\Controller\Packs;


use App\Repository\PackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AddPanierController extends  AbstractController
{
    /**
     * @Route("/pack/addPack/{id}", name="cart_addPack")
     */
    public function addPack(int $id, SessionInterface $session, PackRepository $packRepository){
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);

        $panierWithData = [];

        foreach ($panier as $id=> $quantity){
            $panierWithData[] = [
                'pack'=>$packRepository->find($id),
                'quantity'=> $quantity
            ];
        }
        // dd($panierWithData);
        return $this->redirectToRoute('cart', [ 'panier'=>$panierWithData]);
    }

}