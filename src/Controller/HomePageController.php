<?php

namespace App\Controller;

use App\Entity\VehicleRental;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Pack;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function home(ManagerRegistry $doctrine): Response
    {
        $pack = $doctrine->getRepository(Pack::class);
        $listPack = $pack->findAll();

        $location = $doctrine->getRepository(VehicleRental::class);
        $listLocation = $location->findAll();

        return $this->render('homePage/homepage.html.twig', [
            'controller_name' => 'HomePageController', 'listPack'=>$listPack, 'listLocation' =>$listLocation
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
