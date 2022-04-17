<?php


namespace App\Controller\Packs;


use App\Entity\Pack;
use App\Entity\VehicleRental;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadPackController extends AbstractController
{
    /**
     * @Route("/admin/pack/all", name="allPacks")
     */
    public function showAllPacks(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req): Response
    {

        $conn = $em->getConnection();
        $type = "0";
        $packs = $em->getRepository(Pack::class)->findPacks($type,$em);
        $packs = $paginator->paginate(
            $packs,
            $req->query->getInt('page', 1),
            3
        );
        return $this->render('admin/Packs/showAllPacks.html.twig', [
            'packs' =>  $packs
        ]);
    }

    #[Route('/admin/pack/{id}', name:'onePack', methods:['GET'])]
    public function showOnePack(PersistenceManagerRegistry $em, int $id): Response
    {
        $pack = $em->getRepository(Pack::Class)->find($id);;
        return $this->render('admin/Packs/onePack.html.twig', [
            'id' => $id,
            'pack' => $pack
        ]);
    }


}