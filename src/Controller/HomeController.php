<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', []);
    }

    #[Route('/about', name: 'app_about')]
    public function aboutUs(): Response
    {
        return $this->render('home/about.html.twig', []);
    }
}
