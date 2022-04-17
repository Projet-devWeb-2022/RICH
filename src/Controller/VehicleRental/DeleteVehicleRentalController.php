<?php


namespace App\Controller\VehicleRental;


use App\Entity\Prestation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteVehicleRentalController extends AbstractController
{
    #[Route('/admin/vehicle/rental/delete/{id}' ,name:'deleteRentalVehicle', methods:['GET','DELETE'])]
    public function deleteRentalVehicle($id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $vehicle = $em->getRepository(Prestation::class)->find($id);
        if (!$vehicle) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $em->remove($vehicle);
        $em->flush();
        $this->addFlash('success','Suppression réussie');
        return $this->redirectToRoute("allRentalVehicles");
    }
}