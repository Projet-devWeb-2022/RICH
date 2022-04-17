<?php


namespace App\Controller\Packs;
use App\Entity\Pack;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeletePackController
{
    #[Route('/admin/pack/delete/{id}' ,name:'deletePack', methods:['GET','DELETE'])]
    public function deletePack($id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $pack = $em->getRepository(Pack::class)->find($id);
        if (!$pack) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $em->remove($pack);
        $em->flush();
        $this->addFlash('success','Suppression réussie');
        return $this->redirectToRoute("allPacks");
    }
}