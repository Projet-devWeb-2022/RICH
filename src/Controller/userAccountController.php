<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class userAccountController extends AbstractController
{

    /**
     * @Route("/profile", name="app_profile")
     */
    public function home(): Response
    {
        return $this->render('userAccountPage/userAccount.html.twig');
    }

    /**
     * @Route("/profile/orders", name="app_profile_orders")
     */
    public function orders(): Response
    {
        return $this->render('userAccountPage/userOrders.html.twig');
    }

    /**
     * @Route("/debug")
     */
    public function debug(): Response
    {
        $object = new \stdClass();
        $object->title = 'Tintin';
        $object->createdAt = new \DateTime();

        dump($object);

        return $this->render('baseUser.html.twig');
    }
}
