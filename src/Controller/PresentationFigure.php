<?php


namespace App\Controller;

use App\Entity\Figure;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentationFigure extends AbstractController
{
    #[Route('/presentationfigure/{id}', name: 'app_presentation')]
    public function index(Figure $figure): Response
    {
        return $this->render('pagePresentationFigure/PresentationFigure.html.twig', [
            'figure' => $figure,
        ]);
    }
}