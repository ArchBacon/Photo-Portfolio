<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_spaced')]
    public function index(): Response
    {
        return $this->render('home/spaced.html.twig');
    }

    #[Route('/shifted', name: 'home_shifted')]
    public function shifted(): Response
    {
        return $this->render('home/shifted.html.twig');
    }

    #[Route('/spaced', name: 'home_spaced_multi')]
    public function spaced(): Response
    {
        return $this->render('home/spaced-3-items.html.twig');
    }

    #[Route('/right', name: 'home_aligned_right')]
    public function right(): Response
    {
        return $this->render('home/aligned-right.html.twig');
    }

    #[Route('/left', name: 'home_aligned_left')]
    public function left(): Response
    {
        return $this->render('home/aligned-left.html.twig');
    }

    #[Route('/centered', name: 'home_centered')]
    public function centered(): Response
    {
        return $this->render('home/centered.html.twig');
    }
}
