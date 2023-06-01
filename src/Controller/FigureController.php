<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Image;
use App\Form\FigureType;
use App\Repository\CommentaireRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\FigureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;



class FigureController extends AbstractController
{
    #[Route("/figure", name:"app_figure")]

    public function index(FigureRepository $repository): Response
    {
        $figures = $repository->findAll();

        return $this->render('creationFigures/Figure.html.twig', [
            'figures' => $figures,
            'figure' => null,
        ]);
    }

    #[Route('/figure/create', name: 'app_figure_create', methods: ['GET', 'POST'])]
    public function create(Request $request, FigureRepository $figureRepository, EntityManagerInterface $entityManager): Response
    {
        $figure = new Figure();
        $figure->setImages(new ArrayCollection());

        $form = $this->createForm(FigureType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $figure->setUser($this->getUser());

            // Gestion de l'upload d'image
            $images = $form->get('images')->getData();
            if (empty($images)) {
                // Aucune image téléchargée, définir une image par défaut
                $defaultImageName = 'pexels-nikita.jpg'; // Nom de l'image par défaut
                $defaultImage = new Image();
                $defaultImage->setNomDeFichier($defaultImageName);
                $figure->addImage($defaultImage);
            } else {
                foreach ($images as $image) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('images_directory'),
                    $imageName
               ); }

                $imageEntity = new Image();
                $imageEntity->setNomDeFichier($imageName); // Utilisez le nom généré pour l'image
                $figure->addImage($imageEntity);

                $entityManager->persist($imageEntity); // Utilisez $entityManager au lieu de persist()
            }

            $entityManager->flush();


            /*
                        // Gestion de l'upload de vidéo
                        $videos = $form->get('videos')->getData();
                        foreach ($videos as $video) {
                            // Logique pour traiter l'upload de vidéo
                            // ...

                            $figure->addVideo($video);
                        }*/

            $figureRepository->save($figure, true);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('creationFigures/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route("/figure/edit/{id}", name: "app_figure_edit", methods: ["GET", "POST"])]
    public function edit(Request $request, $id, EntityManagerInterface $entityManager): Response
    {
        $figure = $entityManager->getRepository(Figure::class)->find($id);

        // Récupérer les images originales de la figure
        $originalImages = new ArrayCollection();
        foreach ($figure->getImages() as $image) {
            $originalImages->add($image);
        }

        $form = $this->createForm(FigureType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Supprimer les images supprimées dans le formulaire
            foreach ($originalImages as $image) {
                if (false === $figure->getImages()->contains($image)) {
                    $figure->removeImage($image);
                    $entityManager->remove($image);
                }
            }

            // Mettre à jour les relations entre les images et la figure
            foreach ($figure->getImages() as $image) {
                $image->setFigure($figure);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('modificationFigure/edit.html.twig', [
            'figure' => $figure,
            'form' => $form->createView(),
        ]);
    }



    #[Route("/figure/delete/{id}", name: "app_figure_delete", methods: ["POST", "DELETE"])]
    public function delete(Request $request, Figure $figure): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($figure);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    private function getDoctrine()
    {
     return $this->doctrine;
    }

    public function show(Figure $figure)
    {
        // Récupérer les commentaires liés à la figure
        $commentaires = $figure->getCommentaires();

        return $this->render('pagePresentationFigure/PresentationFigure.html.twig', [
            'figure' => $figure,
            'commentaires' => $commentaires,
        ]);
    }



}
