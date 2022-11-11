<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideosController extends AbstractController
{
    #[Route('/videos/1', name: 'app_videos_index1')]
    public function index(): Response
    {
        return $this->render('videos/index1.html.twig', [
            'controller_name' => 'VideosController',
        ]);
    }

    #[Route('/videos/2', name: 'app_videos_index2')]
    public function index2(): Response
    {
        return $this->render('videos/index2.html.twig', [
            'controller_name' => 'VideosController',
        ]);
    }
}
