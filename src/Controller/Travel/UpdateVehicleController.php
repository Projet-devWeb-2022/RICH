<?php


namespace App\Controller\Travel;


use App\Entity\Prestation;
use App\Form\TravelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateVehicleController extends AbstractController
{
    #[Route('/admin/travel/edit/{id}', name:'editTravel', methods:['GET','POST'])]
    public function updateTravel(Request $request , EntityManagerInterface $entityManager, int $id ): Response
    {
        $travel= $entityManager->getRepository(Prestation::Class)->find($id);
        $form = $this->createForm(TravelType::class, $travel);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $travel = $form->getData();
            $entityManager->persist($travel);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Travel mis à jour avec succès !'
            );
            return $this->redirectToRoute("allTravels");
        }
        return $this->render('admin/travel/editTravel.html.twig', [
            'form' => $form->createView()
        ]);
    }

}