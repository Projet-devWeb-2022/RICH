<?php


namespace App\Controller;


use App\Entity\Destination;
use App\Entity\Vehicle;
use App\Form\VehicleType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DestinationController extends AbstractController
{
    /**
     * @Route("/admin/destination/all", name="allDestinations")
     */
    public function showDestinations(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req): Response
    {
        $repo = $em->getRepository(Destination::Class);
        $destination =  $repo->findAll();
        $destination = $paginator->paginate(
            $destination,
            $req->query->getInt('page', 1),
            3
        );

        return $this->render('admin/Destination/showAllDestinations.html.twig', [
            'destinations' => $destination
        ]);
    }


    #[Route('/admin/destination/new', name:"newDestination", methods:['GET','POST'])]
    public function createVehicle(Request $request , EntityManagerInterface $entityManager ): Response
    {
        $destination = new Destination();
        $form = $this->createForm(VehicleType::class, $destination);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $destination = $form->getData();
            $entityManager->persist($destination);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Destination créé avec succès !'
            );
            return $this->redirectToRoute("allVehicles");

        }

        return $this->render('admin/Destination/newDestination.html.twig', [
            'form' => $form->createView()
        ]);
    }





}