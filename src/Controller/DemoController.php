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

    /** Home Pages */
    #[Route('/', name: '_home')]
    public function home(): Response
    {
        return $this->redirectToRoute('app_demo_home_shifted');
    }

    #[Route('/home/pushed', name: '_home_pushed')]
    public function pushed(): Response
    {
        return $this->render('demo/home/pushed.html.twig');
    }

    #[Route('/home/shifted', name: '_home_shifted')]
    public function shifted(): Response
    {
        return $this->render('demo/home/shifted.html.twig');
    }

    #[Route('/home/centered', name: '_home_centered')]
    public function centered(): Response
    {
        return $this->render('demo/home/centered.html.twig');
    }

    #[Route('/home/spaced', name: '_home_spaced')]
    public function spaced(): Response
    {
        return $this->render('demo/home/spaced.html.twig');
    }

    #[Route('/home/left', name: '_home_left')]
    public function left(): Response
    {
        return $this->render('demo/home/left-aligned.html.twig');
    }

    #[Route('/home/right', name: '_home_right')]
    public function right(): Response
    {
        return $this->render('demo/home/right-aligned.html.twig');
    }

    /** Home Pages */
    #[Route('/contact', name: '_contact')]
    public function contact(): Response
    {
        return $this->redirectToRoute('app_demo_contact_dropped');
    }

    #[Route('/contact/dropped', name: '_contact_dropped')]
    public function dropped(): Response
    {
        return $this->render('demo/contact/dropped.html.twig');
    }

    #[Route('/contact/inline', name: '_contact_inline')]
    public function inline(): Response
    {
        return $this->render('demo/contact/inline.html.twig');
    }
}
