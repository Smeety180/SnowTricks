<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FigureController extends AbstractController
{
    #[Route('/figure', name: 'app_figure')]
    public function index(): Response
    {
        return $this->render('creationFigures/Figure.html.twig', [
            'controller_name' => 'FigureController',
        ]);
    }
}