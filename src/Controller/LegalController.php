<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/legal')]
final class LegalController extends AbstractController
{
    #[Route('/mentions', name: 'app_legal_mentions')]
    public function mentions(): Response
    {
        return $this->render('legal/mentions.html.twig');
    }

    #[Route('/cgu', name: 'app_legal_cgu')]
    public function cgu(): Response
    {
        return $this->render('legal/cgu.html.twig');
    }

    #[Route('/cgv', name: 'app_legal_cgv')]
    public function cgv(): Response
    {
        return $this->render('legal/cgv.html.twig');
    }

    #[Route('/confidentialite', name: 'app_legal_privacy')]
    public function privacy(): Response
    {
        return $this->render('legal/privacy.html.twig');
    }

    #[Route('/qui-sommes-nous', name: 'app_legal_about')]
    public function about(): Response
    {
        return $this->render('legal/about.html.twig');
    }
}
