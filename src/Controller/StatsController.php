<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Manga;

class StatsController extends AbstractController {

    /**
     * @Route("/stats", name="stats")
     */
    public function index(ManagerRegistry $doctrine): Response {

        $mangas = $doctrine->getRepository(Manga::class)->findAll();
        $scoreStats = [];

        for ($i = 0; $i < 10; $i++) 
            $scoreStats[] = count(array_filter($mangas, fn($manga) => $manga->getScore() >= $i && $manga->getScore() < $i + 1));
        
        return $this->render('stats/index.html.twig', [
            'scoreStats' => $scoreStats
        ]);
    }
}
