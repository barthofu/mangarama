<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController {
    
    /**
     * @Route("/movie/add", name="movieAdd")
     */
    public function add(Request $request, ManagerRegistry $doctrine): Response {

        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($movie->getImage() !== null) {

                $file = $form->get('image')->getData();
                $fileName =  uniqid() . '.' . $file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'), // Le dossier dans lequel le fichier va être charger
                        $fileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $movie->setImage($fileName);
            }

            $entityManager = $doctrine->getManager(); // On récupère l'entity manager
            $entityManager->persist($movie); // On confie notre entité à l'entity manager (on persist l'entité)
            $entityManager->flush(); // On execute la requete

            return new Response('Le film a bien été enregistré');

        }

        return $this->render('movie/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/movie/edit/{id}", name="movieEdit", requirements={"id"="\d+"})
     */
    public function edit(Movie $movie): Response {
        
        $form = $this->createForm(MovieType::class, $movie);

        return $this->render('movie/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView()
        ]);
    }
}
