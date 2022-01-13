<?php

namespace App\Controller;

# services
use App\Service\FileUpload;
use App\Service\Token;

# entities and types
use App\Entity\Book;
use App\Form\BookType;

# symfony and doctrine
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class BookController extends AbstractController {
    
    /**
     * @Route("/book/{id}", name="book", requirements={"id"="\d+"})
     */
    public function index(Book $book): Response {
        
        return $this->render('book/edit.html.twig', [
            'book' => $book
        ]);
    }


    /**
     * @Route("/book/add", name="bookAdd")
     */
    public function add(
        # http
        Request $request,
        # doctrine 
        ManagerRegistry $doctrine,
        # services 
        FileUpload $fileUpload
        # ----
        ): Response {

        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($book->getImage() !== null) {

                $file = $form->get('image')->getData();
                $fileName = $fileUpload->upload($file);

                $book->setImage($fileName);
            }

            $entityManager = $doctrine->getManager(); // On récupère l'entity manager
            $entityManager->persist($book); // On confie notre entité à l'entity manager (on persist l'entité)
            $entityManager->flush(); // On execute la requete

            return new Response('Le film a bien été enregistré');

        }

        return $this->render('book/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/book/delete/{id}", name="bookDelete", requirements={"id"="\d+"})
     */
    public function delete(
        # parameters
        Book $book, 
        # doctrine
        ManagerRegistry $doctrine,
        # services
        Token $token
        # ---
        ): RedirectResponse {

        $token->verify();

        $entityManager = $doctrine->getManager();

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
