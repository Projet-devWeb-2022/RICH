<?php


namespace App\Controller\Vehicle;


use App\Entity\Vehicle;
use App\Form\VehicleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateVehicleController extends AbstractController
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
}