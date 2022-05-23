<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\Settings;
use App\Form\SettingsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SettingsController extends BaseController
{
    #[Route('/admin/settings', name: 'admin_settings')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $settings = $entityManager
            ->getRepository(Settings::class)
            ->findAll()[0];
        $form = $this->createForm(SettingsType::class, $settings);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $settings = $form->getData();

            $entityManager->persist($settings);
            $entityManager->flush();
        }

        return $this->render('admin/settings/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
