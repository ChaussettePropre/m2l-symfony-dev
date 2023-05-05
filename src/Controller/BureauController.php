<?php

namespace App\Controller;

use App\Entity\Association;
use App\Entity\Bureau;
use App\Entity\Ligue;
use App\Form\BureauType;
use App\Form\LigueType;
use App\Form\SallercategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class BureauController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('bureau/listebureauxdisponibles.html.twig', [
            'controller_name' => 'BureauController',
        ]);
    }

    public function listebureauxdisponibles()
    {
        $bureaux = $this->getDoctrine()->getRepository(Bureau::class)->findAll();
        return $this->render('bureau/listebureauxdisponibles.html.twig', ['titre' => "Liste des bureaux", 'bureaux' => $bureaux]);

    }

    public function attribuerbureau(Request $request, $id)
    {
        $occupant = $this->getDoctrine()->getRepository(Bureau::class)->find($id);
        $ligues = $this->getDoctrine()->getRepository(Ligue::class)->findAll();

        /*$formattri = $this->createForm(BureauType::class, $ligue);*/
        $formattri = $this->createForm(BureauType::class,$occupant, ['ligues'=>$ligues]);
        $formattri->handleRequest($request);

        if ($formattri->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($occupant);
            $entityManager->flush();

            return $this->render('bureau/vueattribuerbureau.html.twig', ['bureau' => $occupant, 'ligue' => $ligues, 'formattri' => $formattri->createView()]);
        }
        return $this->render('bureau/vueattribuerbureau.html.twig', ['bureau' => $occupant, 'ligue' => $ligues, 'formattri' => $formattri->createView()]);
    }
}
