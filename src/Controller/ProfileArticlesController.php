<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile/articles')]
class ProfileArticlesController extends AbstractController
{
    #[Route('/', name: 'app_profile_articles_index', methods: ['GET'])]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('profile_articles/index.html.twig', [
            'articles' => $articlesRepository->findBy(['auteur'=>$this->getUser()]),
        ]);
    }

    #[Route('/new', name: 'app_profile_articles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ArticlesRepository $articlesRepository): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);
        $article->setAuteur($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {
            $articlesRepository->save($article, true);

            return $this->redirectToRoute('app_profile_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profile_articles/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profile_articles_show', methods: ['GET'])]
    public function show(Articles $article): Response
    {
        return $this->render('profile_articles/show.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_profile_articles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Articles $article, ArticlesRepository $articlesRepository): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articlesRepository->save($article, true);

            return $this->redirectToRoute('app_profile_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profile_articles/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profile_articles_delete', methods: ['POST'])]
    public function delete(Request $request, Articles $article, ArticlesRepository $articlesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $articlesRepository->remove($article, true);
        }

        return $this->redirectToRoute('app_profile_articles_index', [], Response::HTTP_SEE_OTHER);
    }
}
