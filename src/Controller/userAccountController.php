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

    /**
     * @Route("/debug")
     */
    public function debug(): Response
    {
        $object = new \stdClass();
        $object->title = 'Tintin';
        $object->createdAt = new \DateTime();

        dump($object);

        return $this->render('base.html.twig');
    }
}
