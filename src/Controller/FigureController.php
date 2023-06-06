<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Image;
use App\Entity\Video;
use App\Form\FigureType;
use App\Repository\CommentaireRepository;
use App\Repository\ImageRepository;
use App\Repository\VideoRepository;
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
    #[Route("/figure", name: "app_figure")]
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
            $this->uploadImages($images, $figure);

            // Gestion de l'upload de vidéo
            $videoUrl = $form->get('videos')->getData();
            if (!empty($videoUrl)) {
                $this->uploadVideos($videoUrl, $figure);
            }

            $figureRepository->save($figure, true);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('creationFigures/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route("/figure/edit/{id}", name: "app_figure_edit", methods: ["GET", "POST"])]
    public function edit(Request $request, $id, EntityManagerInterface $entityManager, ImageRepository $imageRepository, VideoRepository $videoRepository): Response
    {
        $figure = $entityManager->getRepository(Figure::class)->find($id);

        $form = $this->createForm(FigureType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Supprimer toutes les images déjà rattachées à la figure
            foreach ($figure->getImages() as $image) {
                $imageRepository->remove($image);
            }

            //Supprimer toutes les vidéos déjà rattachées à la figure
            foreach ($figure->getVideos() as $video) {
                $videoRepository->remove($video);
            }

            // Gestion de l'upload d'image
            $images = $form->get('images')->getData();
            $this->uploadImages($images, $figure);

            // Gestion de l'upload de vidéo
            $videoUrl = $form->get('videos')->getData();
            if (!empty($videoUrl)) {
                $this->uploadVideos($videoUrl, $figure);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('modificationFigure/edit.html.twig', [
            'figure' => $figure,
            'form' => $form->createView(),
        ]);
    }

    private function uploadImages($images, $figure)
    {
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
                );

                $imageEntity = new Image();
                $imageEntity->setNomDeFichier($imageName); // Utilisez le nom généré pour l'image
                $figure->addImage($imageEntity);
            }
        }
    }

    private function uploadVideos($videoUrl, $figure)
    {
        $videoEntity = new Video();
        $videoEntity->setUrl($videoUrl);
        $figure->addVideo($videoEntity);
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
