<?php


namespace App\Controller\Destinations;

use App\Entity\Destination;
use App\Form\DestinationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateDestinationController extends AbstractController
{
    #[Route('/admin/destination/new', name:"newDestination", methods:['GET','POST'])]
    public function createDestination(Request $request , EntityManagerInterface $entityManager ): Response
    {
        $destination = new Destination();
        $form = $this->createForm(DestinationType::class,  $destination);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $destination = $form->getData();
            $entityManager->persist($destination);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Destination créé avec succès !'
            );
            return $this->redirectToRoute("allDestinations");
        }
        return $this->render('admin/Destination/newDestination.html.twig', [
            'form' => $form->createView()
        ]);
    }

}