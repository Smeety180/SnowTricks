<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageConnectionController extends AbstractController
{
    #[Route('/connection', name: 'app_connect')]
    public function index(): Response
    {
        return $this->render('pageConnection/Connection.html.twig', [
            'controller_name' => 'PageConnectionController',
        ]);
    }
}