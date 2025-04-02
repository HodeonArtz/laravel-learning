<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $filmIds = Film::pluck("id")->toArray();
    $actorIds = DB::table("actors")->pluck("id")->toArray();
    foreach ($filmIds as $filmId) {
      $randomAmountOfRelations = rand(1, 3);

      // Array of random actorIds with random length between 1-3
      $randomActors = array_map(
        fn($key) => $actorIds[$key],
        (array) array_rand($actorIds, $randomAmountOfRelations)
      );

      foreach ($randomActors as $actorId) {
        DB::table("films_actors")->insert([
          "film_id" => $filmId,
          "actor_id" => $actorId,
        ]);
      }
    }
  }
}
