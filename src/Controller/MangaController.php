<?php

namespace App\Controller;

# services
use App\Service\FileUpload;
use App\Service\Token;
use App\Service\MangaApi;
use App\Service\CSV;

# entities and types
use App\Entity\Manga;
use App\Form\MangaType;

# symfony and doctrine
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class MangaController extends AbstractController {
    
    /**
     * @Route("/manga/{id}", name="manga", requirements={"id"="\d+"})
     */
    public function index(Manga $manga, Request $req, ManagerRegistry $doctrine): Response {

        $voteForm = $this->createFormBuilder()
            ->add('vote', NumberType::class, ['scale' => 2, 'label' => 'Votre score'])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer'])
            ->getForm();

        $voteForm->handleRequest($req);

        if ($voteForm->isSubmitted() && $voteForm->isValid()) {

            $entityManager = $doctrine->getManager();

            $average = $manga->getScore();

            $size = $manga->getVotersNumber();
            $value = $voteForm->get('vote')->getData();
            
            $manga->setScore(
                ($size * $average + $value) / ($size + 1)
            );
            $manga->setVotersNumber($size + 1);

            $entityManager->flush();
        }

        return $this->render('manga/index.html.twig', [
            'manga' => $manga,
            'voteForm' => $voteForm->createView()
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
                    $form->get('score')->setData(explode('/', $result->score)[0]);
                    $form->get('votersNumber')->setData($result->votersNumber);
                } else {
                    $this->addFlash('error', 'Aucun résultat trouvé');
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
    
                $this->addFlash('success', 'Le manga a bien été ajouté');
                return $this->redirectToRoute('mangaAdd');

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

        $this->addFlash('success', 'Le manga a bien été supprimé');
        
        return $this->redirectToRoute('homepage');
    }


    /**
     * @Route("/manga/bulkImport", name="mangaBulkImport")
     */
    public function bulkImport(
        # http
        Request $req,
        # services
        CSV $csv
        ) {

        $form = $this->createFormBuilder()
                ->add('csv', FileType::class, ['label' => 'Fichier CSV'])
                ->add('submit', SubmitType::class, ['label' => 'Envoyer'])
                ->getForm();
        
        $form->handleRequest($req);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $form->get('csv')->getData();
            
            $csv->parse($file);
            $csv->saveToDb();

            $this->addFlash('success', 'Les mangas ont bien été importés');
        }

        return $this->render('manga/bulk_import.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
