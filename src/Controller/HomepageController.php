<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Manga;

class HomepageController extends AbstractController {

    /**
     * @Route("/", name="homepage")
     */
    public function index(ManagerRegistry $doctrine): Response {

        $mangas = $doctrine->getRepository(Manga::class)->findBy([], ['score' => 'DESC','name' => 'ASC']);
        $lastAdded = $doctrine->getRepository(Manga::class)->findBy([], [ 'id' => 'DESC' ], 3, 0);

        $temp = $lastAdded[0];
        $lastAdded[0] = $lastAdded[1];
        $lastAdded[1] = $temp;

        return $this->render('homepage/index.html.twig', [
            'mangas' => $mangas,
            'lastAdded' => $lastAdded
        ]);
    }
}
