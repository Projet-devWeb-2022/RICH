<?php


namespace App\Controller\Vehicle;


use App\Entity\Vehicle;
use App\Form\VehicleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateVehicleController extends AbstractController
{
    #[Route('/admin/vehicle/edit/{id}', name:'editVehicle', methods:['GET','POST'])]
    public function updateVehicle(Request $request , EntityManagerInterface $entityManager, int $id ): Response
    {
        $repo = $entityManager->getRepository(Vehicle::Class);
        $vehicle =  $repo->find($id);
        $form = $this->createForm(VehicleType::class, $vehicle);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $form->getData();
            $entityManager->persist($vehicle);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Vehicule mis à jour avec succès !'
            );
            return $this->redirectToRoute("allVehicles");
        }

        return $this->render('admin/Vehicle/editVehicle.html.twig', [
            'form' => $form->createView()
        ]);
    }


}