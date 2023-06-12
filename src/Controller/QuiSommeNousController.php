<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class QuiSommeNousController extends AbstractController
{
    #[Route('/qui_somme_nous', name: 'app_qui_somme_nous')]
    public function index(Security $security,EntityManagerInterface $entityManager): Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $top_users = $userRepository->createQueryBuilder('u')
            ->where('u.freelancer = :freelancer')
            ->setParameter('freelancer', true)
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();


        return $this->render('qui_somme_nous/index.html.twig', [
            'controller_name' => 'QuiSommeNousController',
            'isGranted' => $security->isGranted('ROLE_USER'),
            'user' => $this->getUser(),
            'top_freelance' => $top_users
        ]);
    }
}
