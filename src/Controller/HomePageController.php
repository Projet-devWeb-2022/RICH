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
    public function home(): Response
    {
        return $this->render('homePage/homepage.html.twig');
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
