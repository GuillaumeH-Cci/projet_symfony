<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    #[IsGranted('ROLE_USER')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'articles' => $articleRepository->findBy(['usr' => $user]) 
        ]);
    }

    #[Route('/profile/edit', name: 'app_profile_edit')]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        // Vérifie que l'utilisateur existe et est bien l'entité User
        if (!$user instanceof User) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        $form = $this->createForm(ProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $existingUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
            if ($existingUser && $existingUser->getId() !== $user->getId()) {
                $this->addFlash('danger', 'Cette adresse email est déjà utilisée par un autre compte.');
            } else {
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Profil mis à jour avec succès.');

                return $this->redirectToRoute('app_profile');
            }
        }

        return $this->render('profile/edit.html.twig', [
            'profileForm' => $form->createView(),
        ]);
    }

    #[Route('/profile/user/{id}', name: 'app_user_update')]
    public function update(User $user, ArticleRepository $articleRepository): Response
    {
        // Logique pour afficher les détails de l'utilisateur ou permettre la modification
        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'articles' => $articleRepository->findBy(['usr' => $user]) 
        ]);
    }
}
