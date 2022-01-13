<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Token {

    private string $adminToken;
    private RequestStack $requestStack;

    public function __construct(string $admin_token, RequestStack $requestStack) {
        $this->adminToken = $admin_token; 
        $this->requestStack = $requestStack;
    }

    public function verify(): bool {
    
        $req = $this->requestStack->getCurrentRequest();
        $submittedToken = $req->request->get('token');

        if (!$submittedToken || $submittedToken !== $this->adminToken) 
            throw new AccessDeniedHttpException('Cette action nécessite un token valide !');

        return true;
    }
}