<?php

declare(strict_types=1);

namespace App\Controller;

use Exception;
use Faker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function count;

class HomeController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $images = [];
        for ($i = 0; $i < 24; $i++) {
            $images[] = sprintf('https://picsum.photos/seed/%s/400', random_int(1, 200));
        }

        $tags = [];
        for ($i = 0; $i < 8; $i++) {
            $tags[] = sprintf('https://picsum.photos/seed/%s/400', random_int(1, 200));
        }

        return $this->render('home/index.html.twig', [
            'images' => self::generateImages($images),
            'tags' => self::generateTags($tags),
        ]);
    }

    private static function generateTags(array $inTags): array
    {
        $tags = [];
        $faker = Faker\Factory::create();

        foreach ($inTags as $image) {
            $tags[] = [
                'url' => $image,
                'name' => $faker->text(26),
            ];
        }

        return $tags;
    }

    private static function generateImages(array $inImages): array
    {
        $steps = [5, 7, 3, 5, 7, 9];
        $stepIterator = 0;
        $compound = 0;

        $images = [];

        foreach ($inImages as $key => $image) {
            $images[] = [
                'url' => $image,
                'large' => $key === $compound,
            ];

            if ($key === $compound) {
                $compound += $steps[$stepIterator];
                $stepIterator++;
            }

            if ($stepIterator === count($steps)) {
                $stepIterator = 0;
            }
        }

        return $images;
    }
}
