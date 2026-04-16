<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use App\Repository\PlateformeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(UserRepository $userRepository, ArticleRepository $articleRepository, PlateformeRepository $plateformeRepository): Response
    {
        $userCount = $userRepository->countAll();
        $postCount = $articleRepository->countAll();
        $consoleCount = $plateformeRepository->countAll();
        
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'userCount' => $userCount,
            'postCount' => $postCount,
            'consoleCount' => $consoleCount,
        ]);
    }
}
