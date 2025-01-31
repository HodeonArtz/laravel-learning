<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Event\Code\Throwable;


class FilmController extends Controller
{

  /**
   * Read films from storage
   */
  public static function readFilms(): array
  {
    $films = Storage::json('/public/films.json');
    return $films;
  }
  /**
   * List films older than input year 
   * if year is not infomed 2000 year will be used as criteria
   */
  public function listOldFilms($year = null)
  {
    $old_films = [];
    if (is_null($year))
      $year = 2000;

    $title = "Listado de Pelis Antiguas (Antes de $year)";
    $films = FilmController::readFilms();

    foreach ($films as $film) {
      //foreach ($this->datasource as $film) {
      if ($film['year'] < $year)
        $old_films[] = $film;
    }
    return view('films.list', ["films" => $old_films, "title" => $title]);
  }
  /**
   * List films younger than input year
   * if year is not infomed 2000 year will be used as criteria
   */
  public function listNewFilms($year = null)
  {
    $new_films = [];
    if (is_null($year))
      $year = 2000;

    $title = "Listado de Pelis Nuevas (Después de $year)";
    $films = FilmController::readFilms();

    foreach ($films as $film) {
      if ($film['year'] >= $year)
        $new_films[] = $film;
    }
    return view('films.list', ["films" => $new_films, "title" => $title]);
  }

  public function listFilmsByGenre($genre)
  {
    $films = FilmController::readFilms();
    $filtered_films = array_filter($films, function ($film) use ($genre) {
      return preg_match("/$genre/i", $film["genre"]);
    });

    return view("films.list", ["films" => $filtered_films, "title" => "Listado de pelis con el género $genre"]);
  }
  public function listFilmsByYear($year)
  {
    $films = FilmController::readFilms();
    $filtered_films = array_filter($films, function ($film) use ($year) {
      return +$film["year"] === +$year;
    });

    return view("films.list", ["films" => $filtered_films, "title" => "Listado de pelis del año $year"]);
  }

  /**
   * Lista TODAS las películas o filtra x año o categoría.
   */
  public function listFilms($year = null, $genre = null)
  {
    $films_filtered = [];

    $title = "Listado de todas las pelis";
    $films = FilmController::readFilms();

    //if year and genre are null
    if (is_null($year) && is_null($genre))
      return view('films.list', ["films" => $films, "title" => $title]);

    //list based on year or genre informed
    foreach ($films as $film) {
      if ((!is_null($year) && is_null($genre)) && $film['year'] == $year) {
        $title = "Listado de todas las pelis filtrado x año";
        $films_filtered[] = $film;
      } else if ((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
        $title = "Listado de todas las pelis filtrado x categoria";
        $films_filtered[] = $film;
      } else if (!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
        $title = "Listado de todas las pelis filtrado x categoria y año";
        $films_filtered[] = $film;
      }
    }
    return view("films.list", ["films" => $films_filtered, "title" => $title]);
  }

  public function sortFilms()
  {
    $films = FilmController::readFilms();
    usort($films, function ($a, $b) {
      return $b['year'] <=> $a['year'];
    });
    return view("films.list", ["films" => $films, "title" => "Películas ordenadas por año (más reciente a más antigua)"]);
  }
  public function countFilms()
  {
    $countFilms  = count(FilmController::readFilms());
    return view("films.message", ["message" => "Actualmente hay $countFilms película(s)"]);
  }


  public function isFilm($film): bool
  {
    if (in_array($film["name"], array_column($this->readFilms(), "name")))
      return false;
    return true;
  }

  public function createFilm(Request $request)
  {
    if (!$this->isFilm($request))
      return view("welcome", ["error" => "Ha habido un error al añadir una película o ya existe una película con el mismo nombre"]);

    $newFilm = [
      "name" => $request->name,
      "year" => $request->year,
      "genre" => $request->genre,
      "country" => $request->country,
      "duration" => $request->duration,
      "img_url" => $request->img_url,
    ];

    Storage::put(
      "/public/films.json",
      json_encode($newFilm, JSON_PRETTY_PRINT)
    );

    return $this->listFilms();
  }
}
