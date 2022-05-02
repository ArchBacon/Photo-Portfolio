<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = (new User())
            ->setName('Admin User')
            ->setEmail('admin@email.com')
            ->setPassword('$2y$13$r4p9dQduHumzspidje5dyeYAC.XeiWtk5pguyWg1Kh7V5RaMvoB7C') // password
            ->setRoles(['ROLE_SUPER_ADMIN'])
        ;
        $manager->persist($user);
        $manager->flush();
    }
}
