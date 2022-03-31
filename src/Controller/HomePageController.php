<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function home(ManagerRegistry $doctrine): Response
    {
        $pack = $doctrine->getRepository(Pack::class);
        $listePack = $pack->findAll();

        return $this->render('homePage/homepage.html.twig', [
            'controller_name' => 'DestinationPageController', 'listDestination'=>$listePack
        ]);
    }

    /**
     * @Route("/destination")
     */
    public function goToDestination(): Response
    {
        return $this->render('destinationPage/destinationPage.html.twig');
    }

    /**
     * @Route("/ok")
     */
    public function goTo2(): Response
    {
        return $this->render('homePage/homepage.html.twig');
    }
}
