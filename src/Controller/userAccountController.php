<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class userAccountController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function home(): Response
    {
        return $this->render('userAccountPage/userAccount.html.twig');
    }
}
