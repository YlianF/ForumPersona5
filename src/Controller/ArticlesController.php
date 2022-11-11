<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\Articles1Type;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/articles')]
class ArticlesController extends AbstractController
{

    #[Route('/categories', name: 'app_articles_index_categories', methods: ['GET'])]
    public function index_categories(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index_categories.html.twig', [
            'articles' => $articlesRepository->findBy(['categorie'=>'categories']),
        ]);
    }

    //ROUTES VERS TOUTES LES CATEGORIES

    #[Route('/fanart', name: 'app_articles_index_fanart', methods: ['GET'])]
    public function index_fanart(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index_fanart.html.twig', [
            'articles' => $articlesRepository->findBy(['categorie'=>'fanart']),
        ]);
    }

    #[Route('/speedrun', name: 'app_articles_index_speedrun', methods: ['GET'])]
    public function index_speedrun(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index_speedrun.html.twig', [
            'articles' => $articlesRepository->findBy(['categorie'=>'speedrun']),
        ]);
    }

    #[Route('/autres', name: 'app_articles_index_autres', methods: ['GET'])]
    public function index_autres(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index_autres.html.twig', [
            'articles' => $articlesRepository->findBy(['categorie'=>'autres']),
        ]);
    }

    #[Route('/anime', name: 'app_articles_index_anime', methods: ['GET'])]
    public function index_anime(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index_anime.html.twig', [
            'articles' => $articlesRepository->findBy(['categorie'=>'anime']),
        ]);
    }

    #[Route('/jeu', name: 'app_articles_index_jeu', methods: ['GET'])]
    public function index_jeu(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index_jeu.html.twig', [
            'articles' => $articlesRepository->findBy(['categorie'=>'jeu']),
        ]);
    }

    #[Route('/personnage', name: 'app_articles_index_personnage', methods: ['GET'])]
    public function index_personnage(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index_personnage.html.twig', [
            'articles' => $articlesRepository->findBy(['categorie'=>'personnage']),
        ]);
    }





    #[Route('/', name: 'app_articles_index', methods: ['GET'])]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }

    
    #[Route('/{id}', name: 'app_articles_show', methods: ['GET'])]
    public function show(Articles $article): Response
    {
        return $this->render('articles/show.html.twig', [
            'article' => $article,
        ]);
    }

    

}
