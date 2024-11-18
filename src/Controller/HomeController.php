<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home/index')]
    public function index() : Response
    {
        $titre = "Accueil";

        return $this->render("home/index.html.twig", compact('titre'));
    }
}
