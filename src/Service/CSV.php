<?php

namespace App\Service;

use App\Entity\Manga;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CSV {

    private array $content;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entity_manager) {
        $this->content = [];
        $this->entityManager = $entity_manager;
    }

    public function parse(UploadedFile $file) {
        
        $handler = fopen($file->getRealPath(), "r");
        $header = NULL;
        
        if ($handler !== FALSE) {
            
            while (($row = fgetcsv($handler, 1000, ";")) !== FALSE) {     
                if (!$header)
                    $header = $row;
                else
                    $this->content[] = array_combine($header, $row);
            }

            fclose($handler);
        }

    }

    public function saveToDb() {

        foreach ($this->content as $key => $value) {
            
            $manga = new Manga();
            $manga->setName($value['name']);
            $manga->setDescription(utf8_encode($value['description']));
            $manga->setScore($value['score']);

            $this->entityManager->persist($manga);
            $this->entityManager->flush();
        }

    }
}