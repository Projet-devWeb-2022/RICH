<?php


namespace App\Controller\Vehicle;


use App\Entity\Vehicle;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadVehicleController extends AbstractController
{
    /**
     * @Route("/admin/vehicle/all", name="allVehicles")
     */
    public function showVehicles(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req): Response
    {
        $repo = $em->getRepository(Vehicle::Class);
        $vehicles =  $repo->findAll();
        $vehicles = $paginator->paginate(
            $vehicles, // Requête contenant les données à paginer (ici nos articles)
            $req->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );

        return $this->render('admin/Vehicle/showVehicles.html.twig', [
            'vehicles' => $vehicles
        ]);
    }

    /**
     * @Route("/admin/vehicle/{id}", name="oneVehicle")
     */
    public function showOneVehicle(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req, $id): Response
    {
        $repo = $em->getRepository(Vehicle::Class);
        $vehicle =  $repo->find($id);
        return $this->render('admin/Vehicle/oneVehicle.html.twig', [
            'id' => $id,
            'vehicle' => $vehicle
        ]);
    }

}