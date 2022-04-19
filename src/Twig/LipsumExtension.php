<?php

declare(strict_types=1);

namespace App\Twig;

use Faker;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LipsumExtension extends AbstractExtension
{
	private Faker\Generator $faker;
	
	public function __construct()
	{
		$this->faker = Faker\Factory::create();
	}
	
	public function getFunctions()
	{
		return [
			new TwigFunction('lipsum', [$this, 'generateLipsum']),
		];
	}
	
	public function generateLipsum(int $words = 300): string
	{
		return $this->faker->text($words);
	}
}