<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'playlists' => $user->getPlaylists(),
        ]);
    }
}
