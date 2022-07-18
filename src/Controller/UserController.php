<?php

namespace App\Controller;

use App\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user", methods="get")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }

    /**
     * @Route("/user", name="save_user", methods="post")
     */
    public function saveUser(ManagerRegistry $doctrine): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $user = new User();
        $user->setName("irwan");
        $user->setAddress("Jalan raden patah");
        $user->setIsActive(true);
        $user->setCreatedAt(new DateTime());

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json([
            'message' => 'success',
            'data' => $user,
        ]);
    }
}
