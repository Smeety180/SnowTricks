<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifFigureController extends AbstractController
{
    #[Route('/modification', name: 'app_modif')]
    public function index(): Response
    {
        return $this->render('modificationFigure/ModifFigure.html.twig', [
            'controller_name' => 'ModifFigureController',
        ]);
    }
}