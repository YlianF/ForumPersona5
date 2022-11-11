<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactType;
use App\Form\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, ContactRepository $contactRepository): Response
    {
        $form=$this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data=$form->getData();

            $contact = new Contact();
            $contact->setAuteur($this->getUser());
            $contact->setMessage($data['message']);


            $contactRepository->save($contact, true);

            return $this->render('contact/success.html.twig');

        } else {
            return $this->renderForm('contact/index.html.twig', [
                'controller_name' => 'ContactController',
                'formulaire' => $form
            ]);

        }

        
    }
}
