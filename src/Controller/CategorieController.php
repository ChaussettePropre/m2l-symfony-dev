<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Sallereservable;
use App\Form\CategorieType;
use App\Form\TarifType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategorieController extends AbstractController
{
    public function categories()
    {
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        return $this->render('categorie/categories.html.twig',['titre'=>"Liste des categories de salles",'categories'=>$categories]);
    }

    public function newCategorie(Request $request): Response
    {
        $categorie = new Categorie();

        $formCategorie = $this->createForm(CategorieType::class,$categorie);
        $formCategorie->handleRequest($request);

        if ($formCategorie->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();
            return $this->render('categorie/newcategoriesucces.html.twig', ['titre' => "Catégorie ajouté"]);
        }

        return $this->render('categorie/newcategorie.html.twig',['form'=> $formCategorie->createView(), 'titre' => "Ajout d'une catégorie de salle"]);
    }

    public function CategorieSalle($id)
    {
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->find($id);
        $salles = $this->getDoctrine()->getRepository(Sallereservable::class)->findByCategorie($categorie);

        return $this->render('categorie/unecategorie.html.twig',[
            'categorie'=>$categorie,
            'salle'=>$salles
        ]);
    }

    public function tarifs()
    {
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        return $this->render('categorie/tarif/tarifs.html.twig',['titre'=>"Prix de la location d'une salle à la journée",'categories'=>$categories]);

    }

    public function newTarif(Request $request, $id): Response
    {
        $tarif = $this->getDoctrine()->getRepository(Categorie::class)->find($id);

        $formTarif = $this->createForm(TarifType::class,$tarif);
        $formTarif->handleRequest($request);

        if ($formTarif->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tarif);
            $entityManager->flush();

            return $this->render('categorie/tarif/newtarifsucces.html.twig', ['titre' => "Tarif modifié"]);
        }

        return $this->render('categorie/tarif/newtarif.html.twig',['form'=> $formTarif->createView(), 'titre' => "Modification d'un tarif"]);
    }

}
