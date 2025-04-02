<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmDirectorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $filmIds = Film::pluck("id")->toArray();
    $directorIds = DB::table("directors")->pluck("id")->toArray();
    foreach ($filmIds as $filmId) {
      $randomAmountOfRelations = rand(1, 3);

      // Array of random directorIds with random length between 1-3
      $randomDirectors = array_map(
        fn($key) => $directorIds[$key],
        (array) array_rand($directorIds, $randomAmountOfRelations)
      );

      foreach ($randomDirectors as $directorId) {
        DB::table("films_directors")->insert([
          "film_id" => $filmId,
          "director_id" => $directorId,
        ]);
      }
    }
  }
}
