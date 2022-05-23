<?php

declare(strict_types=1);

namespace App\Controller;

use Faker;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function count;

class HomeController extends BaseController
{
    /** @noinspection PhpClosureCanBeConvertedToShortArrowFunctionInspection */
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'images' => self::generateImages(array_map(static function (int $index): string {
                return sprintf('https://picsum.photos/seed/%s/400', $index);
            }, range(1, 48))),
            'tags' => self::generateTags(array_map(static function (int $index): string {
                return sprintf('https://picsum.photos/seed/%s/400', $index);
            }, range(49, 54))),
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
