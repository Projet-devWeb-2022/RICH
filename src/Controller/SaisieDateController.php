<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SaisieDateController extends AbstractController
{
    /**
     * @Route("/saisieDate")
     */
    public function index(): Response
    {
        return $this->render('saisieDate/saisieDate.html.twig', [
            'controller_name' => 'SaisieDateController',
        ]);
    }
}
