<?php

namespace App\Controller;

use App\Entity\Destination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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

}
