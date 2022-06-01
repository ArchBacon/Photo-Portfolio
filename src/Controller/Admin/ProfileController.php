<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Settings;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'admin_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $settings = $entityManager
            ->getRepository(Settings::class)
            ->findAll()[0];
        $form = $this->createForm(ProfileType::class, $settings);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $settings = $form->getData();
//            $file = new File($settings->avatar());
//            $newFilename = Uuid::uuid4()->toString() . '.' . $file->guessExtension();
//            $basename = $this->getParameter('kernel.project_dir') . '/public/avatar/' . $newFilename;
//            $filesystem->rename($file->getRealPath(), $basename);
//
//            $settings->setAvatar($newFilename);
            $entityManager->persist($settings);
            $entityManager->flush();
        }

        return $this->render('admin/profile/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
