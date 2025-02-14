<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmFakeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Factory::create();

    for ($i = 0; $i < 10; $i++) {
      DB::table("films")->insert([
        "name" => $faker->words(3, true),
        "year" => $faker->year(),
        "genre" => $faker->words(1, true),
        "country" => $faker->countryISOAlpha3(),
        "duration" => $faker->numberBetween(90, 320),
        "img_url" => $faker->imageUrl(),
      ]);
    }
  }
}
