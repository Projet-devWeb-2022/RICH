<?php


namespace App\Controller;

use App\Entity\Prestation;
use App\Entity\Vehicle;
use App\Entity\VehicleRental;
use App\Form\RentalVehicleType;
use App\Form\VehicleType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class VehicleController extends AbstractController
{
    #[Route('/admin/vehicle/new', name:"newVehicle", methods:['GET','POST'])]
    public function createVehicle(Request $request , EntityManagerInterface $entityManager ): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $form->getData();
            $entityManager->persist($vehicle);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Vehicle créé avec succès !'
            );
            return $this->redirectToRoute("allVehicles");

        }

        return $this->render('admin/Vehicle/newVehicle.html.twig', [
            'form' => $form->createView()
        ]);
    }


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


    //RentalVehicle
    #[Route('/admin/vehicle/rental/new', name:"newRentalVehicle", methods:['GET','POST'])]
    public function createRentalVehicle(Request $request , EntityManagerInterface $entityManager, ): Response
    {
        $rentalVehicle = new VehicleRental();
        $form = $this->createForm(RentalVehicleType::class, $rentalVehicle);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rentalVehicle = $form->getData();
            $entityManager->persist($rentalVehicle);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Vehicle mis en location avec succès !'
            );
            return $this->redirectToRoute("allRentalVehicles");
        }
        return $this->render('admin/Vehicle/RentalVehicles/newRentalVehicle.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/vehicle/rental/all", name="allRentalVehicles")
     */
    public function showRentalVehicles(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req): Response
    {

        $conn = $em->getConnection();
        $type = "vehicleRental";
        $sql = '
            SELECT * FROM prestation p
            WHERE p.prestationType = :type
           
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['type' => $type]);

        $rentalVehicles = $resultSet->fetchAllAssociative();

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


    #[Route('/admin/vehicle/rental/edit/{id}', name:'editRentalVehicle', methods:['GET','POST'])]
    public function updateRentalVehicle(Request $request , EntityManagerInterface $entityManager, int $id ): Response
    {
        $vehicle  = $entityManager->getRepository(Prestation::Class)->find($id);
        $form = $this->createForm(RentalVehicleType::class, $vehicle);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $form->getData();
            $entityManager->persist($vehicle);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Vehicule mis à jour avec succès !'
            );
            return $this->redirectToRoute("allRentalVehicles");
        }

        return $this->render('admin/Vehicle/RentalVehicles/editRentalVehicle.html.twig', [
            'form' => $form->createView()
        ]);
    }

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