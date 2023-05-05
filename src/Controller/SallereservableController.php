<?php

namespace App\Controller;

use App\Entity\Categorie;

use App\Entity\Salle;

use App\Entity\Sallereservable;
use App\Form\CategorieType;
use App\Form\SallercategorieType;
use App\Form\TarifType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SallereservableController extends AbstractController
{
    public function sallesreservable()
    {
        $sallesreservable = $this->getDoctrine()->getRepository(Sallereservable::class)->findAll();
        return $this->render('sallereservable/sallesreservable.html.twig', ['titre' => "Liste des salles réservable", 'sallesreservable' => $sallesreservable]);
    }


    public function categoriesalle(Request $request, $id): Response
    {
        $sallereserv = $this->getDoctrine()->getRepository(Sallereservable::class)->find($id);

        $formCatsaller = $this->createForm(SallercategorieType::class, $sallereserv);
        $formCatsaller->handleRequest($request);

        if ($formCatsaller->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sallereserv);
            $entityManager->flush();

            return $this->render('sallereservable/categoriesallesucces.html.twig', ['titre' => "Catégorie de la salle modifié"]);
        }

        return $this->render('sallereservable/newcatsaller.html.twig', ['form' => $formCatsaller->createView(), 'titre' => "Modifier la catégorie de cette salle", 'salle' => $sallereserv ]);
    }

        public function afficherSalle($id)
        {
            $sallereserv = $this->getDoctrine()->getRepository(Sallereservable::class)->find($id);
            return $this->render('sallereservable/unesallereserv.html.twig',
                ['salle' => $sallereserv]
            );
        }

}
