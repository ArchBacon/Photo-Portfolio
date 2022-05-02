<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Settings;
use App\Repository\SettingsRepository;
use App\Repository\SocialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends AbstractController
{
    protected Settings $settings;

    public function __construct(
        private SocialRepository $socialRepository,
        private SettingsRepository $settingsRepository
    ) {
        $this->settings = $this->settingsRepository->findAll()[0];
    }

    protected function render(string $view, array $parameters = [], Response $response = null): Response
    {
        $parameters['socials'] = $this->socialRepository->findAllActive();
        $parameters['settings'] = $this->settings;

        return parent::render($view, $parameters, $response);
    }
}
