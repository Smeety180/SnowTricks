<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentationFigure extends AbstractController
{
    #[Route('/presentationfigure', name: 'app_presentation')]
    public function index(): Response
    {
        return $this->render('pagePresentationFigure/PresentationFigure.html.twig', [
            'controller_name' => 'PresentationController',
        ]);
    }
}