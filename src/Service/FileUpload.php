<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileUpload {

    private string $uploadDir;

    public function __construct($uploadDir) {
        $this->uploadDir = $uploadDir; 
    }

    public function upload(UploadedFile $file) {

        $fileName =  uniqid() . '.' . $file->guessExtension();

        try {
            $file->move(
                $this->uploadDir, // Le dossier dans lequel le fichier va être charger
                $fileName
            );

            return $fileName;

        } catch (FileException $e) {
            return $e;
        }

    }
}