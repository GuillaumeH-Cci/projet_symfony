<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Plateforme;
use App\Form\ArticleType;
use App\Form\PlateformeType;
use App\Repository\ArticleRepository;
use App\Repository\PlateformeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GameController extends AbstractController
{
    #[Route('/games', name: 'app_games')]
    public function games(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findBy([], ['article_creation_date' => 'DESC']);

        return $this->render('game/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/consoles', name: 'app_consoles')]
    public function consoles(PlateformeRepository $plateformeRepository): Response
    {
        $platforms = $plateformeRepository->findAll();

        return $this->render('platform/index.html.twig', [
            'platforms' => $platforms,
        ]);
    }

    #[Route('/games/add', name: 'app_game_new')]
    public function newGame(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setArticleCreationDate(new \DateTimeImmutable());
            $article->setUsr($this->getUser());

            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'Jeu ajouté avec succès.');

            return $this->redirectToRoute('app_games');
        }

        return $this->render('game/add.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }

    #[Route('/consoles/add', name: 'app_console_new')]
    public function newConsole(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $platform = new Plateforme();
        $form = $this->createForm(PlateformeType::class, $platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($platform);
            $entityManager->flush();

            $this->addFlash('success', 'Console ajoutée avec succès.');

            return $this->redirectToRoute('app_consoles');
        }

        return $this->render('platform/add.html.twig', [
            'consoleForm' => $form->createView(),
        ]);
    }

    #[Route('/games/edit/{id}', name: 'app_game_edit')]
    public function editGame(Article $article, Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $updateForm = $this->createForm(ArticleType::class, $article);
        $updateForm->handleRequest($request);

        if ($updateForm->isSubmitted() && $updateForm->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Jeu modifié avec succès.');
            return $this->redirectToRoute('app_games');
        }

        return $this->render('game/edit.html.twig', [
            'article' => $article,
            'articleForm' => $updateForm->createView(),
        ]);
    }

    #[Route('/consoles/edit/{id}', name: 'app_console_edit')]
    public function editConsole(Plateforme $platform, Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $updateForm = $this->createForm(PlateformeType::class, $platform);
        $updateForm->handleRequest($request);

        if ($updateForm->isSubmitted() && $updateForm->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Console modifiée avec succès.');
            return $this->redirectToRoute('app_consoles');
        }

        return $this->render('platform/edit.html.twig', [
            'platform' => $platform,
            'consoleForm' => $updateForm->createView(),
        ]);
    }

    #[Route('/games/delete/{id}', name: 'app_game_delete')]
    public function deleteGame(Article $article, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $entityManager->remove($article);
        $entityManager->flush();

        $this->addFlash('success', 'Jeu supprimé avec succès.');
        return $this->redirectToRoute('app_games');
    }

    #[Route('/consoles/delete/{id}', name: 'app_console_delete')]
    public function deleteConsole(Plateforme $platform, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $entityManager->remove($platform);
        $entityManager->flush();

        $this->addFlash('success', 'Console supprimée avec succès.');
        return $this->redirectToRoute('app_consoles');
    }

    #[Route('/games/{id}', name: 'app_game_show')]
    public function showGameArticle(Article $article): Response
    {   
        return $this->render('game/show.html.twig', [
            'article' => $article,
        ]);
    }
}