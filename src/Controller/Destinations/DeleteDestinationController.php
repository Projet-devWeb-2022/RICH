<?php


namespace App\Controller\Destinations;


use App\Entity\Destination;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteDestinationController extends AbstractController
{
    #[Route('/admin/destination/delete/{id}' ,name:'deleteDestination', methods:['GET','DELETE'])]
    public function deleteDestination($id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $destination = $em->getRepository(Destination::class)->find($id);
        if (!$destination) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $em->remove($destination);
        $em->flush();
        $this->addFlash('success','Suppression réussie');
        return $this->redirectToRoute("allDestinations");
    }
}