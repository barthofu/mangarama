<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Movie;

class HomepageController extends AbstractController {

    /**
     * @Route("/", name="homepage")
     */
    public function index(ManagerRegistry $doctrine): Response {

        $movies = $doctrine->getRepository(Movie::class)->findAll();

        return $this->render('homepage/index.html.twig', [
            'movies' => $movies
        ]);
    }
}
