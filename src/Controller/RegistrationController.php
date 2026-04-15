<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier si l'email existe déjà
            $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
            if ($existingUser) {
                $this->addFlash('danger', 'Veuillez choisir une autre adresse email.');
                return $this->render('registration/index.html.twig', [
                    'registrationForm' => $form->createView(),
                ]);
            }

            $plainPassword = $form->get('plainPassword')->getData();
            $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));
            $user->setUserCreationDate(new \DateTimeImmutable());
            $user->setRoles(['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Inscription réussie, vous pouvez maintenant vous connecter.');

            return $this->redirectToRoute('app_register');
        }

        return $this->render('registration/index.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
