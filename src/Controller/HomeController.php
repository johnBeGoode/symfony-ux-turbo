<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\UX\Turbo\TurboBundle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
            $this->addFlash('success', 'Votre message a bien été envoyé !' );

            if (TurboBundle::STREAM_FORMAT === $request->getPreferredFormat()) {
                // If the request comes from Turbo, set the content type as text/vnd.turbo-stream.html and only send the HTML to update
                $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
                
                return $this->render('partials/_notifications.html.twig');
            }
        }

        $response = new Response('', Response::HTTP_SEE_OTHER, []);

        return $this->render('home/contact.html.twig', [
            'form' => $form
        ], $response);
    }

    #[Route('/about', name: 'app_about')]
    public function aboutUs(): Response
    {
        return $this->render('home/about.html.twig', []);
    }
}
