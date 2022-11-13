<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Articles;
use App\Entity\Contact;
use App\Form\User1Type;
use App\Form\Articles1Type;
use App\Form\ContactType;
use App\Repository\UserRepository;
use App\Repository\ContactRepository;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{

    #[Route('/users', name: 'app_admin_index_users', methods: ['GET'])]
    public function index_users(UserRepository $userRepository): Response
    {
        return $this->render('admin/index_users.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/articles', name: 'app_admin_index_articles', methods: ['GET'])]
    public function index_articles(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('admin/index_articles.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }

    #[Route('/contact', name: 'app_admin_index_contact', methods: ['GET'])]
    public function index_contact(ContactRepository $contactRepository): Response
    {
        return $this->render('admin/index_contact.html.twig', [
            'contact' => $contactRepository->findAll(),
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

    #[Route('/contact/{id}', name: 'app_admin_show_contact', methods: ['GET'])]
    public function show_contact(Contact $contact): Response
    {
        return $this->render('admin/show_contact.html.twig', [
            'contact' => $contact,
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

    #[Route('/contact/{id}', name: 'app_admin_delete_contact', methods: ['POST'])]
    public function delete_contact(Request $request, Contact $contact, ContactRepository $contactRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $contactRepository->remove($contact, true);
        }

        return $this->redirectToRoute('app_admin_index_contact', [], Response::HTTP_SEE_OTHER);
    }

    
}
