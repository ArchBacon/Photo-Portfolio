<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/demo', name: 'app_demo')]
class DemoController extends AbstractController
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $env = $this->container->getParameter('kernel.environment');
        if ($env !== 'dev') {
            throw $this->createNotFoundException();
        }
    }

    #[Route('/', name: '_index')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_demo_pushed');
    }

    #[Route('/pushed', name: '_pushed')]
    public function pushed(): Response
    {
        return $this->render('demo/home/pushed.html.twig');
    }

    #[Route('/shifted', name: '_shifted')]
    public function shifted(): Response
    {
        return $this->render('demo/home/shifted.html.twig');
    }

    #[Route('/centered', name: '_centered')]
    public function centered(): Response
    {
        return $this->render('demo/home/centered.html.twig');
    }

    #[Route('/spaced', name: '_spaced')]
    public function spaced(): Response
    {
        return $this->render('demo/home/spaced.html.twig');
    }

    #[Route('/left', name: '_left')]
    public function left(): Response
    {
        return $this->render('demo/home/left-aligned.html.twig');
    }

    #[Route('/right', name: '_right')]
    public function right(): Response
    {
        return $this->render('demo/home/right-aligned.html.twig');
    }
}
