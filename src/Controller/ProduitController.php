<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Entity\Images;
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProduitRepository;
use App\Repository\ImagesRepository;
use Knp\Component\Pager\PaginatorInterface;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="add_produit")
     */
    public function index(Request $request, EntityManagerInterface $manager)
    {
        $produit = new Produit();

        $form = $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            foreach($produit->getImages() as $img){
                $img->setProduit($produit);
                $manager->persist($img);
            }
            $manager->persist($produit);
            $manager->flush();

            $this->addFlash('success',
                "L'article {$produit->getNom()} a été enregistrer !"
            );
        }

        return $this->render('produit/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/liste", name="liste")
     */
    public function listeproduit(ProduitRepository $produit,PaginatorInterface $paginator, Request $request){
        $pagination = $paginator->paginate(
            $produit->findAll(),
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('produit/liste.html.twig',[
            'produits' => $pagination,
        ]);
    }

    /**
     * @Route("/detail/{id}", name="detail_produit")
     * 
     * @return Response
     */
    public function detailproduit($id, ProduitRepository $prod,  ImagesRepository $imag){
        $produits=$prod->findById($id);
        $image=$imag->findByProduit($id);
        
        return $this->render('produit/detail_produit.html.twig',[
            'produit'=>$produits,
            'images' =>$image,
        ]);
    }

    /**
     * 
     * @Route("modifier/{id}", name="modifier")
     */
    public function modifier($id, ProduitRepository $prod,  ImagesRepository $imag, Request $request, EntityManagerInterface $manager){
        $produits=$prod->findById($id);
        $image=$imag->findByProduit($id);

        $produit = new Produit();
        $form = $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            dd("phat");
        }

        return $this->render('produit/modifier.html.twig',[
            'produit'=>$produits,
            'images' =>$image,
        ]);
    }

}
