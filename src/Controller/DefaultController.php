<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

    public function accueil()
    {
        return $this->render('accueil/accueil.html.twig', ['titre' => "Accueil"]);
    }
}