<?php


namespace App\Controller\VehicleRental;


use App\Entity\Prestation;
use App\Form\RentalVehicleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateVehicleRentalController extends AbstractController
{
    #[Route('/admin/vehicle/rental/edit/{id}', name:'editRentalVehicle', methods:['GET','POST'])]
    public function updateRentalVehicle(Request $request , EntityManagerInterface $entityManager, int $id ): Response
    {
        $vehicle  = $entityManager->getRepository(Prestation::Class)->find($id);
        $form = $this->createForm(RentalVehicleType::class, $vehicle);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $form->getData();
            $entityManager->persist($vehicle);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Vehicule mis à jour avec succès !'
            );
            return $this->redirectToRoute("allRentalVehicles");
        }

        return $this->render('admin/Vehicle/RentalVehicles/editRentalVehicle.html.twig', [
            'form' => $form->createView()
        ]);
    }

}