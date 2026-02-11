<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $utils): Response
    {
        $error = $utils->getLastAuthenticationError();
        $lastEmail = $utils->getLastUsername();
        return $this->render('security/login.html.twig', [
            "error" => $error,
            "last_email" => $lastEmail
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout() {}
}
