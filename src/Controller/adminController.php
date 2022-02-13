<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class adminController extends AbstractController
{

    /**
     * @Route("/admin")
     */
    public function test(): Response
    {
        return $this->render('admin/adminHomePage.html.twig');
    }

    /**
     * @Route("/admin/profil")
     */
    public function test2(): Response
    {
        return $this->render('admin/adminProfilPage.html.twig');
    }

    /**
     * @Route("/admin/offers/addpack")
     */
    public function test3(): Response
    {
        return $this->render('admin/adminAddPack.html.twig');
    }
}
