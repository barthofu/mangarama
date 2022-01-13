<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Book;

class HomepageController extends AbstractController {

    /**
     * @Route("/", name="homepage")
     */
    public function index(ManagerRegistry $doctrine): Response {

        $books = $doctrine->getRepository(Book::class)->findAll();

        return $this->render('homepage/index.html.twig', [
            'books' => $books
        ]);
    }
}
