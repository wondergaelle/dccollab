<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Projet;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController

// création de la page d'accueil
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()

    {
        // rechercher les données das la base de données
        $projets = $this->getDoctrine()->getRepository(Projet::class)->findAll();

        // envoyer les données dans la vue

        return $this->render('default/index.html.twig', [
            'projets'=>$projets,
        ]);
    }
}
