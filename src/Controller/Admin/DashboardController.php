<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Repository\ImageRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends BaseController
{
    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    #[Route('/admin', name: 'admin_dashboard')]
    public function index(ImageRepository $imageRepository): Response
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'public_images' => $imageRepository->countPublic(),
            'total_uploads' => $imageRepository->countAll(),
            'missing_thumbnails' => $imageRepository->countMissingThumbs(),
        ]);
    }
}
