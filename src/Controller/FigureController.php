<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Image;
use App\Form\FigureType;
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
            foreach ($images as $image) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('images_directory'),
                    $imageName
                );

                $imageEntity = new Image();
                $imageEntity->setNomDeFichier($imageName); // Utilisez le nom généré pour l'image
                $figure->addImage($imageEntity);

                $entityManager->persist($imageEntity); // Utilisez $entityManager au lieu de persist()
            }

            $entityManager->flush(); // Déplacez flush() en dehors de la boucle foreach


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
    public function edit(Request $request, Figure $figure): Response
    {
        $form = $this->createForm(FigureType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_figure');
        }

        return $this->render('creationFigures/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

   #[Route("/figure/delete/{id}", name: "app_figure_delete", methods: ["DELETE"])]
    public function delete(Request $request, Figure $figure): Response
    {
        if ($this->isCsrfTokenValid('delete' . $figure->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($figure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_figure');
    }

}
