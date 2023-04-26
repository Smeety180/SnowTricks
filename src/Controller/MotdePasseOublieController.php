<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MotdePasseOublieController extends AbstractController
{
    #[Route('/MotdePasseOublie', name: 'app_MotdePasseOublie')]
    public function index(): Response
    {
        return $this->render('mdpOublie/MdpOublie.html.twig', [
            'controller_name' => 'MotdePasseOublieController',
        ]);
    }
}
