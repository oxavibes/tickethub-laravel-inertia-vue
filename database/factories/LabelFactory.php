<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Label>
 */
class LabelFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$title = fake()->sentence(2);

		$slug = Str::slug($title);
		$visible = fake()->boolean();

		return [
			'title' => $title,
			'slug' => $slug,
			'visible' => $visible,
		];
	}
}
