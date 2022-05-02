<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\SettingsRepository;
use App\Repository\SocialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends AbstractController
{
    public function __construct(
        private SocialRepository $socialRepository,
        private SettingsRepository $settingsRepository
    )
    {
    }

    protected function render(string $view, array $parameters = [], Response $response = null): Response
    {
        $parameters['socials'] = $this->socialRepository->findAllActive();
        $parameters['appName'] = $this->settingsRepository->findAll()[0]?->appName();

        return parent::render($view, $parameters, $response);
    }
}
