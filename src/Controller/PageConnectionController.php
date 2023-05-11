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
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        // Gérer la soumission du formulaire de connexion ici
        // Vérifier les informations d'identification de l'utilisateur et effectuer l'authentification

        // Rediriger l'utilisateur après la connexion réussie
        return $this->redirectToRoute('app_home');

        // Récupérer les erreurs de connexion, le dernier nom d'utilisateur entré, etc.
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        // Créer le formulaire de connexion
        $form = $this->createForm(LoginFormType::class, [
            'email' => $lastUsername,
        ]);

        return $this->render('login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }

}