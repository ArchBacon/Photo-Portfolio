<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Settings;
use App\Entity\Social;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SocialFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        /** @var Settings $settings */
        $settings = $this->getReference(SettingsFixtures::SETTINGS);

        // Facebook
        $social = (new Social())
            ->setName('Facebook')
            ->setIcon('facebook')
            ->setUrl(null)
            ->setSettings($settings);
        $manager->persist($social);

        // Twitter
        $social = (new Social())
            ->setName('Twitter')
            ->setIcon('twitter')
            ->setUrl(null)
            ->setSettings($settings);
        $manager->persist($social);

        // Instagram
        $social = (new Social())
            ->setName('Instagram')
            ->setIcon('instagram')
            ->setUrl(null)
            ->setSettings($settings);
        $manager->persist($social);

        // Youtube
        $social = (new Social())
            ->setName('Youtube')
            ->setIcon('youtube')
            ->setUrl(null)
            ->setSettings($settings);
        $manager->persist($social);

        // Twitch
        $social = (new Social())
            ->setName('Twitch')
            ->setIcon('twitch')
            ->setUrl(null)
            ->setSettings($settings);
        $manager->persist($social);

        // External
        $social = (new Social())
            ->setName(null)
            ->setIcon('external-link')
            ->setUrl(null)
            ->setSettings($settings);
        $manager->persist($social);

        $manager->flush();
    }
}
