<?php


namespace App\Controller;

use App\Entity\Figure;
use App\Repository\FigureRepository;
use App\Form\CommentaireType;
use Knp\Component\Pager\PaginatorInterface;// Nous appelons le bundle KNP Paginator
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commentaire;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class PresentationFigure extends AbstractController
{
    #[Route('/presentationfigure/{id}', name: 'app_presentation')]
    public function index(Figure $figure, Request $request, EntityManagerInterface $entityManager, Security $security, PaginatorInterface $paginator, FigureRepository $figureRepository): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setUser($security->getUser()); // Lier automatiquement l'utilisateur connecté au commentaire
        $commentaire->setDateMsg(new \DateTime()); // Définir automatiquement la date actuelle
        $commentaire->setFigure($figure); // Lier automatiquement la figure associée

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);


        // Pagination

        $pagination = $paginator->paginate(
        $figureRepository->paginationQuery(),
        $request->query->get('page', 1),
            2
        );


        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement du formulaire

            // Par exemple, persistez l'entité Commentaire en base de données

            $entityManager->persist($commentaire);
            $entityManager->flush();


            return $this->redirectToRoute('app_presentation', ['id' => $figure->getId()]);
        }

        return $this->render('pagePresentationFigure/PresentationFigure.html.twig', [
            'figure' => $figure,
            'commentaire' => $commentaire,
            'pagination' => $pagination,
            'form' => $form->createView(),
        ]);
    }

}