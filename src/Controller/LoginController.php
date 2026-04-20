<?php

namespace App\Controller;

use App\Form\LoginFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $form = $this->createForm(LoginFormType::class, [
        'email' => $authenticationUtils->getEmail(), 
        ]);

        $error = $authenticationUtils->getLastAuthenticationError();
        $email = $authenticationUtils->getEmail();

        return $this->render('login/index.html.twig', [
            'email' => $email,
            'error' => $error,
            'loginForm' => $form->createView(), 
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
