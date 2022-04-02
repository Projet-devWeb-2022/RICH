<?php

namespace App\Controller;

use App\Entity\Pack;
use App\Repository\PackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class PackController extends AbstractController
{
    /**
     * @Route("/pack")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        //Récuperer l'ensemble des destinations de notre base et l'envoyer en parametre a notre vue
        $pack = $doctrine->getRepository(Pack::class);
        $listePack = $pack->findAll();

        return $this->render('pack/packPage.html.twig', [
            'controller_name' => 'PackController', 'listePack'=>$listePack
        ]);
    }


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
