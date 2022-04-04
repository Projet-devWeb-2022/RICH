<?php


namespace App\Controller;

use App\Entity\Destination;
use App\Form\DestinationType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class DestinationController extends AbstractController
{
    /**
     * @Route("/admin/destination/all", name="allDestinations")
     */
    public function showAllDestination(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req): Response
    {

        $conn = $em->getConnection();
        $type = "0";
        $sql = '
            SELECT * FROM destination p
            WHERE p.id > :type
           
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['type' => $type]);


        $destinations = $resultSet->fetchAllAssociative();

        $destinations = $paginator->paginate(
            $destinations,
            $req->query->getInt('page', 1),
            3
        );
        return $this->render('admin/Destination/showAllDestinations.html.twig', [
            'destinations' =>  $destinations
        ]);
    }


    #[Route('/admin/pack/new', name:"newDestination", methods:['GET','POST'])]
    public function createPack(Request $request , EntityManagerInterface $entityManager ): Response
    {
        $destination = new Destination();
        $form = $this->createForm(Destination::class,  $destination);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $destination = $form->getData();
            $entityManager->persist($destination);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Destination créé avec succès !'
            );
            return $this->redirectToRoute("allDestinations");
        }
        return $this->render('admin/Destination/newDestination.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/admin/destination/{id}', name:'oneDestination', methods:['GET'])]
    public function showOneDestination(PersistenceManagerRegistry $em, int $id): Response
    {
        $destination = $em->getRepository(Destination::Class)->find($id);;
        return $this->render('admin/Destination/oneDestination.html.twig', [
            'pack' => $destination
        ]);
    }

    #[Route('/admin/destination/edit/{id}', name:'editDestination', methods:['GET','POST'])]
    public function updatePack(Request $request , EntityManagerInterface $entityManager, int $id ): Response
    {
        $destination= $entityManager->getRepository(Destination::Class)->find($id);
        $form = $this->createForm(DestinationType::class, $destination);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $destination = $form->getData();
            $entityManager->persist($destination);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Destination mis à jour avec succès !'
            );
            return $this->redirectToRoute("allDestinations");
        }

        return $this->render('admin/Destination/editDestination.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/destination/delete/{id}' ,name:'deleteDestination', methods:['GET','DELETE'])]
    public function deletePack($id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $destination = $em->getRepository(Destination::class)->find($id);
        if (!$destination) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $em->remove($destination);
        $em->flush();
        $this->addFlash('success','Suppression réussie');
        return $this->redirect("/admin/destination/all");
    }

}