<?php


namespace App\Controller\Travel;


use App\Entity\Prestation;
use App\Entity\Travel;
use App\Entity\VehicleRental;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadTravelController extends AbstractController
{
    /**
     * @Route("/admin/travel/all", name="allTravels")
     */
    public function showTravels(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req): Response
    {
        $type = "travel";
        $travels = $em->getRepository(Travel::class)->findTravels($type,$em);
        $travels = $paginator->paginate(
            $travels,
            $req->query->getInt('page', 1),
            3
        );
        return $this->render('admin/Travel/showAllTravel.html.twig', [
            'travels' =>  $travels
        ]);
    }

    #[Route('/admin/travel/{id}', name:'oneTravel', methods:['GET'])]
    public function showOneTravel(PersistenceManagerRegistry $em, int $id): Response
    {
        $travel = $em->getRepository(Prestation::Class)->find($id);;
        return $this->render('admin/Travel/oneTravel.html.twig', [
            'id' => $id,
            'travel' => $travel
        ]);
    }



}