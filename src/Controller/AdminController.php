<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Articles;
use App\Form\User1Type;
use App\Form\Articles1Type;
use App\Repository\UserRepository;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{

    #[Route('/articles', name: 'app_admin_index_articles', methods: ['GET'])]
    public function index_articles(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('admin/index_articles.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }

    #[Route('/users', name: 'app_admin_index_users', methods: ['GET'])]
    public function index_users(UserRepository $userRepository): Response
    {
        return $this->render('admin/index_users.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }



    #[Route('/', name: 'app_admin_index', methods: ['GET'])]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('admin/index.html.twig');
    }




    // ROUTES SHOW
    #[Route('users/{id}', name: 'app_admin_show_users', methods: ['GET'])]
    public function show_user(User $user): Response
    {
        return $this->render('admin/show_users.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/articles/{id}', name: 'app_admin_show_articles', methods: ['GET'])]
    public function show_articles(Articles $articles): Response
    {
        return $this->render('admin/show_articles.html.twig', [
            'articles' => $articles,
        ]);
    }



    // ROUTES DELETE
    #[Route('/users/{id}', name: 'app_admin_delete_users', methods: ['POST'])]
    public function delete_users(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_admin_index_users', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/articles/{id}', name: 'app_admin_delete_articles', methods: ['POST'])]
    public function delete_articles(Request $request, Articles $articles, ArticlesRepository $articlesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articles->getId(), $request->request->get('_token'))) {
            $articlesRepository->remove($articles, true);
        }

        return $this->redirectToRoute('app_admin_index_articles', [], Response::HTTP_SEE_OTHER);
    }

    
}
