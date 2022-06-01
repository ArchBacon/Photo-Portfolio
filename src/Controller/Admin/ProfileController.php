<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Settings;
use App\Form\AvatarType;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/admin/profile', name: 'admin_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $settings = $entityManager
            ->getRepository(Settings::class)
            ->findAll()[0];
        $profileForm = $this->createForm(ProfileType::class, $settings);
        $avatarForm = $this->createForm(AvatarType::class, $settings);

        $profileForm->handleRequest($request);
        if ($profileForm->isSubmitted() && $profileForm->isValid()) {
            /** @var Settings $settings */
            $settings = $profileForm->getData();

            $entityManager->persist($settings);
            $entityManager->flush();
        }

        $avatarForm->handleRequest($request);
        if ($avatarForm->isSubmitted() && $avatarForm->isValid()) {
            /** @var Settings $settings */
            $settings = $avatarForm->getData();
            $avatar = new File($settings->avatar());
            $filename = 'upload.' . $avatar->guessExtension();
            $avatar->move(
                $this->getParameter('kernel.project_dir') . '/public/avatar/',
                $filename,
            );

            $settings->setAvatar($filename);
            $entityManager->persist($settings);
            $entityManager->persist($settings);
            $entityManager->flush();
        }

        return $this->render('admin/profile/index.html.twig', [
            'profile_form' => $profileForm->createView(),
            'avatar_form' => $avatarForm->createView(),
        ]);
    }
}
