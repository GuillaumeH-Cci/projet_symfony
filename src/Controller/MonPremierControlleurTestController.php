<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MonPremierControlleurTestController extends AbstractController
{
    #[Route('/mon/premier/controlleur/test', name: 'app_mon_premier_controlleur_test')]
    public function index(): Response
    {
        return $this->render('mon_premier_controlleur_test/index.html.twig', [
            'controller_name' => 'MonPremierControlleurTestController',
        ]);
    }
}
