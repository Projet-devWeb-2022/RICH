<?php


namespace App\Controller\VehicleRental;


use App\Entity\Prestation;
use App\Entity\VehicleRental;
use App\Form\RentalVehicleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateVehicleRentalController extends AbstractController
{
    #[Route('/admin/vehicle/rental/new', name:"newRentalVehicle", methods:['GET','POST'])]
    public function createRentalVehicle(Request $request , EntityManagerInterface $entityManager, ): Response
    {
        $rentalVehicle = new VehicleRental();
        $form = $this->createForm(RentalVehicleType::class, $rentalVehicle);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rentalVehicle = $form->getData();
            $entityManager->persist($rentalVehicle);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Vehicle mis en location avec succès !'
            );
            return $this->redirectToRoute("allRentalVehicles");
        }
        return $this->render('admin/Vehicle/RentalVehicles/newRentalVehicle.html.twig', [
            'form' => $form->createView()
        ]);
    }

}