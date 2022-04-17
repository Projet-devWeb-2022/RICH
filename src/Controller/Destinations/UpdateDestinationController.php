<?php


namespace App\Controller\Destinations;


use App\Entity\Destination;
use App\Form\DestinationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateDestinationController extends AbstractController
{
    #[Route('/admin/destination/edit/{id}', name:'editDestination', methods:['GET','POST'])]
    public function updateDestination(Request $request , EntityManagerInterface $entityManager, int $id ): Response
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

}