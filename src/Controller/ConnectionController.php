<?php

namespace App\Controller;

use App\Form\UserLoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnectionController extends AbstractController
{
    /**
     * @Route("/login")
     */
    public function index(): Response
    {
        $form = $this->createForm(UserLoginType::class);
        return $this->render('connection/index.html.twig', [
            'form' => $form->createView(),
        ]);

        

    }
}
