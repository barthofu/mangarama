<?php

namespace App\Controller;

# services
use App\Service\FileUpload;
use App\Service\Token;
use App\Service\MangaApi;

# entities and types
use App\Entity\Manga;
use App\Form\MangaType;

# symfony and doctrine
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MangaController extends AbstractController {
    
    /**
     * @Route("/manga/{id}", name="manga", requirements={"id"="\d+"})
     */
    public function index(Manga $manga): Response {
        
        return $this->render('manga/edit.html.twig', [
            'manga' => $manga
        ]);
    }


    /**
     * @Route("/manga/add", name="mangaAdd")
     */
    public function add(
        # http
        Request $request,
        # doctrine 
        ManagerRegistry $doctrine,
        # services 
        FileUpload $fileUpload,
        MangaApi $mangaApi
        # ----
        ): Response {

        $manga = new Manga();
        $form = $this->createForm(MangaType::class, $manga);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('fetchApi')->isClicked()) {

                $result = $mangaApi->fetch($form->get('name')->getData());
                $form = $this->createForm(MangaType::class, $manga);

                if ($result) {
                    $form->get('name')->setData($result->name);
                    $form->get('description')->setData($result->description);
                }

            } else {

                if ($manga->getImage() !== null) {

                    $file = $form->get('image')->getData();
                    $fileName = $fileUpload->upload($file);
    
                    $manga->setImage($fileName);
                }
    
                $entityManager = $doctrine->getManager(); // On récupère l'entity manager
                $entityManager->persist($manga); // On confie notre entité à l'entity manager (on persist l'entité)
                $entityManager->flush(); // On execute la requete
    
                return new Response('Le manga a bien été enregistré');
    
            }
            

        }

        return $this->render('manga/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/manga/delete/{id}", name="mangaDelete", requirements={"id"="\d+"})
     */
    public function delete(
        # parameters
        Manga $manga, 
        # doctrine
        ManagerRegistry $doctrine,
        # services
        Token $token
        # ---
        ): RedirectResponse {

        $token->verify();

        $entityManager = $doctrine->getManager();

        $entityManager->remove($manga);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}
