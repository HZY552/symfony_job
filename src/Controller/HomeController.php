<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Security $security): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'isGranted' => $security->isGranted('ROLE_USER'),
            'user' => $this->getUser(),
        ]);
    }
}
