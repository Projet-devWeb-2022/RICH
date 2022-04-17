<?php


namespace App\Controller\Packs;


use App\Entity\Pack;
use App\Form\PackType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdatePackController extends AbstractController
{
    #[Route('/admin/pack/edit/{id}', name:'editPack', methods:['GET','POST'])]
    public function updatePack(Request $request , EntityManagerInterface $entityManager, int $id ): Response
    {
        $pack= $entityManager->getRepository(Pack::Class)->find($id);
        $form = $this->createForm(PackType::class, $pack);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pack = $form->getData();
            $entityManager->persist($pack);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Pack mis à jour avec succès !'
            );
            return $this->redirectToRoute("allPacks");
        }
        return $this->render('admin/Packs/editPack.html.twig', [
            'form' => $form->createView()
        ]);
    }

}