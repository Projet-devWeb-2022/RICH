<?php


namespace App\Controller;

use App\Entity\Pack;

use App\Form\PackType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Repository\PackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

class PackController extends AbstractController
{
    /**
     * @Route("/pack", name="showPack")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        //Récuperer l'ensemble des destinations de notre base et l'envoyer en parametre a notre vue
        $pack = $doctrine->getRepository(Pack::class);
        $listePack = $pack->findAll();

        return $this->render('pack/packPage.html.twig', [
            'controller_name' => 'PackController', 'listePack'=>$listePack
        ]);
    }

    /**
     * @Route("/admin/pack/all", name="allPacks")
     */
    public function showAllpacks(PersistenceManagerRegistry $em,PaginatorInterface $paginator, Request $req): Response
    {

        $conn = $em->getConnection();
        $type = "0";
        $sql = '
            SELECT * FROM pack p
            WHERE p.price > :type
           
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['type' => $type]);


        $packs = $resultSet->fetchAllAssociative();

        $packs = $paginator->paginate(
            $packs,
            $req->query->getInt('page', 1),
            3
        );
        return $this->render('admin/Packs/showAllPacks.html.twig', [
            'packs' =>  $packs
        ]);
    }



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
    #[Route('/admin/pack/{id}', name:'onePack', methods:['GET'])]
    public function showOnePack(PersistenceManagerRegistry $em, int $id): Response
    {
        $pack = $em->getRepository(Pack::Class)->find($id);;
        return $this->render('admin/Packs/onePack.html.twig', [
            'pack' => $pack
        ]);
    }

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

    #[Route('/admin/pack/delete/{id}' ,name:'deletePack', methods:['GET','DELETE'])]
    public function deletePack($id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $pack = $em->getRepository(Pack::class)->find($id);
        if (!$pack) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $em->remove($pack);
        $em->flush();
        $this->addFlash('success','Suppression réussie');
        return $this->redirect("/admin/pack/all");
    }



    /**
     * @Route("/pack/addPack/{id}", name="cart_addPack")
     */
    public function addPack(int $id, SessionInterface $session, PackRepository $packRepository){
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);

        $panierWithData = [];

        foreach ($panier as $id=> $quantity){
            $panierWithData[] = [
                'pack'=>$packRepository->find($id),
                'quantity'=> $quantity
            ];
        }
        // dd($panierWithData);
        return $this->redirectToRoute('cart', [ 'panier'=>$panierWithData]);
    }
}

