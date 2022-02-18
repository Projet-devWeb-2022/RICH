<?php

namespace App\Controller;

use App\Entity\Pack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}
