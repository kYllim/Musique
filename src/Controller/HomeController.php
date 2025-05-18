<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\AlbumRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, ArtistRepository $artistRepo, AlbumRepository $albumRepo, CommentRepository $commentRepo): Response
    {
        $comments = $commentRepo->findAll();
        $searchTerm = $request->query->get('q', '');
        $filterType = $request->query->get('type', 'all');

        $artists = [];
        $albums = [];

        if ($filterType === 'all' || $filterType === 'artist') {
            $artists = $artistRepo->findBySearchTerm($searchTerm);
        }

        if ($filterType === 'all' || $filterType === 'album') {
            $albums = $albumRepo->findBySearchTerm($searchTerm);
        }

        return $this->render('home/index.html.twig', [
            'artists' => $artists,
            'albums' => $albums,
            'searchTerm' => $searchTerm,
            'filterType' => $filterType,
            'comments'    => $comments,
        ]);
    }


}
