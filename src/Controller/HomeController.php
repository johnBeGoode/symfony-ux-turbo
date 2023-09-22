<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/home.html.twig', []);
    }

    #[Route('/features', name: 'app_features')]
    public function features(): Response
    {
        return $this->render('home/features.html.twig', []);
    }

    #[Route('/contact-us', name: 'app_contact')]
    public function contact(Request $request): Response
    {   
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('Success', 'Votre message a bien été envoyé !' );
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/contact.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function aboutUs(): Response
    {
        return $this->render('home/about.html.twig', []);
    }
}
