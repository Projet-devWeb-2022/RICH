<?php
namespace App\Controller\VehicleRental;

use App\Entity\Prestation;
use App\Entity\VehicleRental;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadVehicleRentalController extends AbstractController
{
    /**
     * @Route("/admin/vehicle/rental/all", name="allRentalVehicles")
     */
    public function showRentalVehicles(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req): Response
    {
        $type = "vehicleRental";
        $rentalVehicles = $em->getRepository(VehicleRental::class)->findRentalVehicles($type,$em);
        $rentalVehicles = $paginator->paginate(
            $rentalVehicles,
            $req->query->getInt('page', 1),
            3
        );

        return $this->render('admin/Vehicle/RentalVehicles/showRentalVehicles.html.twig', [
            'rentalVehicles' =>  $rentalVehicles
        ]);
    }
    /**
     * @Route("rental/all", name="allRental")
     */
    public function showRental(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req)
    {
        $type = "vehicleRental";
        $rentalVehicles = $em->getRepository(VehicleRental::class)->findRentalVehicles($type,$em);
        $rentalVehicles = $paginator->paginate(
            $rentalVehicles,
            $req->query->getInt('page', 1),
            3
        );

        return $this->render('admin/Vehicle/RentalVehicles/showRentalVehicles.html.twig', [
            'rentalVehicles' =>  $rentalVehicles
        ]);
    }

    #[Route('/admin/vehicle/rental/{id}', name:'oneRentalVehicle', methods:['GET'])]
    public function showOneRentalVehicle(PersistenceManagerRegistry $em, int $id): Response
    {
        $rentalVehicle = $em->getRepository(Prestation::Class)->find($id);;
        return $this->render('admin/Vehicle/RentalVehicles/oneRentalVehicle.html.twig', [
            'id' => $id,
            'rentalVehicle' => $rentalVehicle
        ]);
    }

}