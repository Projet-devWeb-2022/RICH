<?php

namespace App\Controller;

use App\Entity\Destination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DestinationPageController extends AbstractController
{
    /**
     * @Route("/destination")
     */
    public function index(): Response
    {
        //Récuperer l'ensemble des destinations de notre base et l'envoyer en parametre a notre vue
        $ListeDestination = $this->getDoctrine()->getRepository(Destination::class)->findAll();

        return $this->render('destinationPage/destinationPage.html.twig', [
            'controller_name' => 'DestinationPageController', 'listeDestination'=>$ListeDestination
        ]);
    }
}
