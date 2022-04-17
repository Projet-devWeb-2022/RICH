<?php


namespace App\Controller\Packs;


use App\Entity\Pack;
use App\Form\PackType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreatePackController extends  AbstractController
{
    #[Route('/admin/pack/new', name:"newPack", methods:['GET','POST'])]
    public function createPack(Request $request , EntityManagerInterface $entityManager ): Response
    {
        $pack = new Pack();
        $form = $this->createForm(PackType::class,  $pack);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pack = $form->getData();
            $entityManager->persist($pack);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Pack créé avec succès !'
            );
            return $this->redirectToRoute("allPacks");
        }
        return $this->render('admin/Packs/newPack.html.twig', [
            'form' => $form->createView()
        ]);
    }

}