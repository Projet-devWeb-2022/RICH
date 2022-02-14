<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class adminController extends AbstractController
{
    //Admin Managemennt
    /**
     * @Route("/admin/home")
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

    //Users
    /**
     * @Route("/admin/users/allusers")
     */
    public function adminShowAllUsers(): Response
    {
        return $this->render('admin/Users/adminAllUsersPages.html.twig');
    }




    //Packs
    /**
     * @Route("/admin/offers/allpacks")
     */

    public function test3(): Response
    {
        return $this->render('adminAllPacksPage.html.twig');
    }

    /**
     * @Route("/admin/offers/addpack")
     */
    public function test4(): Response
    {
        return $this->render('adminAddPackPage.html.twig');
    }


    /**
     * @Route("/admin/offers/pack")
     */
    public function test5(): Response
    {
        return $this->render('admin/Packs/adminOnePackPage.html.twig');
    }

    //Activité





    //Hotel





    //Voiture

}
