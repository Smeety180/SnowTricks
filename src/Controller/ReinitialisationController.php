<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReinitialisationController extends AbstractController
{
    #[Route('/reinitialisation de mot de passe', name: 'app_reinitialisation')]
    public function index(): Response
    {
        return $this->render('ReinitialisationMdp/Reinitialisation.html.twig', [
            'controller_name' => 'ReinitialisationController',
        ]);
    }
}