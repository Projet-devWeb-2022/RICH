<?php


namespace App\Controller\Travel;


use App\Entity\Prestation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteVehicleController extends AbstractController
{
    #[Route('/admin/travel/delete/{id}' ,name:'deleteTravel', methods:['GET','DELETE'])]
    public function deleteTravel($id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $travel = $em->getRepository(Prestation::class)->find($id);
        if (!$travel) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $em->remove($travel);
        $em->flush();
        $this->addFlash('success','Suppression réussie');
        return $this->redirectToRoute("allTravels");
    }
}