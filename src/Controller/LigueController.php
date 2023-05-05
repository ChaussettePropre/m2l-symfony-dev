<?php

namespace App\Controller;


use App\Entity\Association;
use App\Entity\Ligue;
use App\Form\LigueType;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



class LigueController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('ligue/index.html.twig', [
            'controller_name' => 'LigueController',
        ]);
    }

    public function listeligues()
    {
        $ligues = $this->getDoctrine()->getRepository(Ligue::class)->findAll();
        return $this->render('ligue/listeligues.html.twig', ['titre' => "Liste des ligues", 'ligues' => $ligues]);
    }


    public function modifierligue($id, Request $request)
    {
    $bool = $this->getDoctrine()->getRepository(Association::class)
        ->modif_autorise(($this->getUser()->getUsername()),$id);
    $ligue = $this->getDoctrine()->getRepository(Ligue::class)->find($id); //récupère la ligue
    $form = $this->createForm(LigueType::class, $ligue);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {


        $em = $this->getDoctrine()->getManager();
        $em->persist($ligue);
        $em->flush();

        return $this->render('ligue/liguemodifsucces.html.twig', ['titre' => "Ligue modifiée"]);

    }
    return $this->render('ligue/modifierligue.html.twig', [
        'ligue' => $ligue,
        'form' => $form->createView(),
        'bool' => $bool
    ]);
    }


}
