<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\PlateformeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
