<?php

namespace Database\Factories;

use App\Models\Actor;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{

  protected $model = Actor::class;
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $faker = FakerFactory::create();
    return [
      "name" => $faker->words($faker->numberBetween(1, 2), true),
      "surname" => $faker->words(2, true),
      "birthdate" => $faker->date(max: "2006-01-01"),
      "country" => $faker->countryCode(),
      "img_url" => $faker->imageUrl(),
    ];
  }
}