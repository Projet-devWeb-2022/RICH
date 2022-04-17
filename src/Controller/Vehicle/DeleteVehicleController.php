<?php


namespace App\Controller\Vehicle;


use App\Entity\Vehicle;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteVehicleController extends AbstractController
{

    #[Route('/admin/vehicle/delete/{id}' ,name:'deleteVehicle', methods:['GET','DELETE'])]
    public function deleteVehiicle($id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $vehicle = $em->getRepository(Vehicle::class)->find($id);
        if (!$vehicle) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $em->remove($vehicle);
        $em->flush();
        $this->addFlash('success','Suppression réussie');
        return $this->redirectToRoute("allVehicles");
    }
}