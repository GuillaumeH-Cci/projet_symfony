<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{
    
    #[Route('/admin', name: 'app_admin')]
    public function index(UserRepository $userRepo, ArticleRepository $articleRepo, PaginatorInterface $paginator, Request $request) : Response 
    {    
        if (!$this->isGranted('ROLE_ADMIN')) {
        $this->addFlash('error', 'Accès réservé aux administrateurs.');
        return $this->redirect('app_home');
    }
        $searchName = $request->query->get('search_name', '');

        $users = $paginator->paginate(
            $userRepo->findAll(), 
            $request->query->getInt('pageUsers', 1),
            5
        );

        $articles = $paginator->paginate(
            $articleRepo->findAll(),
            $request->query->getInt('pageArticles', 1),
            5
        );

        
        return $this->render('admin/index.html.twig', [
            'users' => $users,
            'articles' => $articles,
            'searchName' => $searchName, 
        ]);
    }   
}
