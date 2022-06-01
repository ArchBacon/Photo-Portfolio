<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Settings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class SettingsFixtures extends Fixture
{
    public const SETTINGS = 'settings';

    private Faker\Generator $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $settings = (new Settings())
            ->setAppName('site.name')
            ->setOccupation('Photographer')
            ->setIntroduction($this->faker->text(300))
        ;

        $manager->persist($settings);
        $manager->flush();

        $this->addReference(self::SETTINGS, $settings);
    }
}
