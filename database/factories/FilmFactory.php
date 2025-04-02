<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $faker = Factory::create();
    return [
      "name" => $faker->words(3, true),
      "year" => $faker->numberBetween(1900, 2024),
      "genre" => $faker->words(1, true),
      "country" => $faker->countryISOAlpha3(),
      "duration" => $faker->numberBetween(90, 320),
      "img_url" => $faker->imageUrl(),
    ];
  }
}
