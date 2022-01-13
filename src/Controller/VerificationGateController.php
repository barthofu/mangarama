<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VerificationGateController extends AbstractController {

    private string $defaultFallbackRoute = '/';

    /**
     * @Route("/verification", name="verificationGate")
     */
    public function index(Request $req): Response {

        $fallbackRoute = $req->query->get('fallbackRoute') ?? $this->defaultFallbackRoute;

        return $this->render('verification_gate/index.html.twig', [
            'fallbackRoute' => $fallbackRoute
        ]);
    }
}
