<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Event\Code\Throwable;


class FilmController extends Controller
{

  /**
   * Read films from storage
   */
  public static function readFilms(): array
  {
    $jsonFilms = Storage::json('/public/films.json');
    $databaseFilms =
      json_decode(
        json_encode(
          Film::select(["name", "year", "genre", "img_url", "country", "duration"])->get()->toArray(),
        ),
        true
      );

    return array_merge($jsonFilms, $databaseFilms);
  }

  public function index()
  {
    return json_encode(FilmController::readFilms());
  }

  public function indexWithActors()
  {
    $films = Film::all()->map(function ($film) {
      return [...$film->toArray(), "actors" => $film->actors()->get()->toArray()];
    });

    return $films->toJson();
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
    return view('components.list', ["elements" => $old_films, "title" => $title]);
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
    return view('components.list', ["elements" => $new_films, "title" => $title]);
  }

  public function listFilmsByGenre($genre)
  {
    $films = FilmController::readFilms();
    $filtered_films = array_filter($films, function ($film) use ($genre) {
      return preg_match("/$genre/i", $film["genre"]);
    });

    return view("components.list", ["elements" => $filtered_films, "title" => "Listado de pelis con el género $genre"]);
  }
  public function listFilmsByYear($year)
  {
    $films = FilmController::readFilms();
    $filtered_films = array_filter($films, function ($film) use ($year) {
      return +$film["year"] === +$year;
    });

    return view("components.list", ["elements" => $filtered_films, "title" => "Listado de pelis del año $year"]);
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
      return view('components.list', ["elements" => $films, "title" => $title]);

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
    return view("components.list", ["elements" => $films_filtered, "title" => $title]);
  }

  public function sortFilms()
  {
    $films = FilmController::readFilms();
    usort($films, function ($a, $b) {
      return $b['year'] <=> $a['year'];
    });
    return view("components.list", ["elements" => $films, "title" => "Películas ordenadas por año (más reciente a más antigua)"]);
  }
  public function countFilms()
  {
    // countFilms() uses only the films stored in the Database
    $countFilms  = Film::count();
    return view("components.message", ["title" => "Películas", "message" => "Actualmente hay $countFilms película(s) en la base de datos"]);
  }


  public function isFilm($film): bool
  {
    if (in_array($film["name"], array_column($this->readFilms(), "name")))
      return false;
    return true;
  }

  public function createFilm(Request $request)
  {
    $saveInSQL = true;

    try {
      if (!$this->isFilm($request))
        return view("welcome", ["films" => FilmController::readFilms(), "error" => "Ya existe una película con el nombre {$request->name}"]);

      $newFilm = [
        "name" => $request->name,
        "year" => $request->year,
        "genre" => $request->genre,
        "country" => $request->country,
        "duration" => $request->duration,
        "img_url" => $request->img_url,
      ];

      $films = [...FilmController::readFilms(), $newFilm];

      if ($saveInSQL)
        Film::insert($newFilm);
      else
        Storage::put(
          "/public/films.json",
          json_encode($films, JSON_PRETTY_PRINT)
        );



      return $this->listFilms();
    } catch (\Throwable $_) {
      return view("welcome", ["films" => FilmController::readFilms(), "error" => "Ha habido un error al añadir la película"]);
    }
  }
}