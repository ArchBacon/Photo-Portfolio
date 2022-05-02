<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Settings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SettingsFixtures extends Fixture
{
    public const SETTINGS = 'settings';

    public function load(ObjectManager $manager): void
    {
        $settings = new Settings();
        $manager->persist($settings);
        $manager->flush();

        $this->addReference(self::SETTINGS, $settings);
    }
}
