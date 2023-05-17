<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifFigureController extends AbstractController
{
    #[Route('/figure/edit', name: 'app_edit')]
    public function index(): Response
    {
        return $this->render('modificationFigure/edit.html.twig', [
            'controller_name' => 'EditFigureController',
        ]);
    }
}