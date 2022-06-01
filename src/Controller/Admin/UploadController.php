<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Repository\ImageRepository;
use App\Service\Plupload;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[Route('/admin/upload', name: 'admin_upload')]
    public function index(Plupload $uploader, ImageRepository $imageRepository): Response
    {
        if ($uploader->isValid()) {
            $uploader->tryAppendChunk();

            if ($uploader->isComplete() && $uploader->save()) {
                $imageRepository->add(new Image($uploader->lastSavedFilename()), true);

                return new Response(sprintf('upload finished. saved to %s', $uploader->lastSavedFile()));
            }

            return new Response(sprintf(
                'Chunk %d/%d uploaded.',
                $uploader->chunkNumber(),
                $uploader->totalChunks()
            ));
        }

        return $this->render('admin/upload/index.html.twig');
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    #[Route('/admin/crop', name: 'admin_crop')]
    public function crop(ImageRepository $imageRepository): Response
    {
        return $this->render('admin/upload/crop.html.twig', [
            'file' => $imageRepository->findOneWithoutThumbs(),
        ]);
    }
}
