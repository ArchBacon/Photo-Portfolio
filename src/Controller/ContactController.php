<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ContactType::class, new Message());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();

            $em->persist($message);
            $em->flush();

            $this->addFlash('notice', 'Your message has been received!');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/mobile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
