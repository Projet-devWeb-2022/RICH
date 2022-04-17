<?php


namespace App\Controller\Travel;


use App\Entity\Travel;
use App\Form\TravelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateTravelController extends AbstractController
{
    #[Route('/admin/travel/new', name:"newTravel", methods:['GET','POST'])]
    public function createVehicle(Request $request , EntityManagerInterface $entityManager ): Response
    {
        $travels = new Travel();
        $form = $this->createForm(TravelType::class,  $travels);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $travels = $form->getData();
            $entityManager->persist($travels);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Travel créé avec succès !'
            );
            return $this->redirectToRoute("allTravels");
        }
        return $this->render('admin/travel/newTravel.html.twig', [
            'form' => $form->createView()
        ]);
    }

}