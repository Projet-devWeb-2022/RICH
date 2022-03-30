<?php


namespace App\Controller;

use App\Entity\Vehicle;
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
    public function new(Request $request , EntityManagerInterface $entityManager ): Response
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
    public function show(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req): Response
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
    public function showOne(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req, $id): Response
    {
        $repo = $em->getRepository(Vehicle::Class);
        $vehicle =  $repo->find($id);
        return $this->render('admin/Vehicle/oneVehicle.html.twig', [
            'vehicle' => $vehicle
        ]);
    }

    #[Route('/admin/vehicle/edit/{id}', name:'editVehicle', methods:['GET','POST'])]
    public function update(Request $request , EntityManagerInterface $entityManager, int $id ): Response
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
    public function delete($id, ManagerRegistry $doctrine): Response
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
        return $this->redirect("/admin/vehicle/all");
    }

}