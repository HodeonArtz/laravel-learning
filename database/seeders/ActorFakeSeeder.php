<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActorFakeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Factory::create();
    for ($i = 0; $i < 10; $i++) {
      DB::table("actors")->insert([
        "name" => $faker->words($faker->numberBetween(1, 2), true),
        "surname" => $faker->words(2, true),
        "birthdate" => $faker->date(max: "2006-01-01"),
        "country" => $faker->countryCode(),
        "img_url" => $faker->imageUrl(),
      ]);
    }
  }
}
