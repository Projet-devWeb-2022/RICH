<?php


namespace App\Controller;

use App\Entity\Prestation;
use App\Entity\Travel;
use App\Form\TravelType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TravelController extends AbstractController
{
    /**
     * @Route("/admin/travel/all", name="allTravels")
     */
    public function showTravels(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req): Response
    {

        $conn = $em->getConnection();
        $type = "travel";
        $sql = '
            SELECT * FROM prestation p
            WHERE p.prestationType = :type
           
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['type' => $type]);


        $travels = $resultSet->fetchAllAssociative();

        $travels = $paginator->paginate(
            $travels,
            $req->query->getInt('page', 1),
            3
        );
        return $this->render('admin/Travel/showAllTravel.html.twig', [
            'travels' =>  $travels
        ]);
    }


    #[Route('/admin/travel/new', name:"newTravel", methods:['GET','POST'])]
    public function createVehicle(Request $request , EntityManagerInterface $entityManager ): Response
    {
        $travels = new Travel();
        $form = $this->createForm(TravelType::class,  $travels);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $travels = $form->getData();
            $entityManager->persist($travels);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Travel créé avec succès !'
            );
            return $this->redirectToRoute("allTravels");
        }
        return $this->render('admin/travel/newTravel.html.twig', [
            'form' => $form->createView()
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

    #[Route('/admin/travel/edit/{id}', name:'editTravel', methods:['GET','POST'])]
    public function updateTravel(Request $request , EntityManagerInterface $entityManager, int $id ): Response
    {
        $travel= $entityManager->getRepository(Prestation::Class)->find($id);
        $form = $this->createForm(TravelType::class, $travel);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $travel = $form->getData();
            $entityManager->persist($travel);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Travel mis à jour avec succès !'
            );
            return $this->redirectToRoute("allTravels");
        }

        return $this->render('admin/travel/editTravel.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/travel/delete/{id}' ,name:'deleteTravel', methods:['GET','DELETE'])]
    public function deleteTravel($id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $travel = $em->getRepository(Prestation::class)->find($id);
        if (!$travel) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $em->remove($travel);
        $em->flush();
        $this->addFlash('success','Suppression réussie');
        return $this->redirectToRoute("allTravels");
    }

}