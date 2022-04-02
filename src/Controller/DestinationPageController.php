<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Repository\DestinationRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class DestinationPageController extends AbstractController
{
    /**
     * @Route("/destination")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        //Récuperer l'ensemble des destinations de notre base et l'envoyer en parametre a notre vue
        $destination = $doctrine->getRepository(Destination::class);
        $listeDestination = $destination->findAll();

        return $this->render('destinationPage/destinationPage.html.twig', [
            'controller_name' => 'DestinationPageController', 'listDestination'=>$listeDestination
        ]);
    }

    /**
     * @Route("/destination/add/{id}", name="cart_add")
     */
    public function add($id, SessionInterface $session, DestinationRepository $destinationRepository){
        //$cartService->add($id); CartService $cartService
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
                'destination'=>$destinationRepository->find($id),
                'quantity'=> $quantity
            ];
        }

        return $this->redirectToRoute('cart', ['items' => $panierWithData]);
    }

}
