<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
  public function index()
  {
    $actors = Actor::all()->map(function ($actor) {
      return [...$actor->toArray(), "films" => $actor->films()->get()->toArray()];
    });

    return $actors->toJson();
  }

  public function listActors()
  {
    // use json_encode and json_decode to transform object to associative array
    $actors = json_decode(json_encode(Actor::get()->toArray()), true);

    return view("components.list", ["elements" => $actors, "title" => "Listado de todos los actores"]);
  }
  public function listActorsByDecade(int $decade)
  {
    $decadeStart = Carbon::create($decade, 1, 1)->startOfYear();
    $decadeEnd = Carbon::create($decade + 9, 12, 31)->endOfYear();

    $actors = json_decode(json_encode(Actor::whereBetween("birthdate", [$decadeStart, $decadeEnd])->get()->toArray()), true);
    return view("components.list", ["elements" => $actors, "title" => "Listado de actores nacidos en la década de los " . $decade . "'s"]);
  }
  public function countActors()
  {
    $actorCount = Actor::count();
    return view("components.message", ["title" => "Actores", "message" => "Actualmente hay $actorCount actor(es)/actriz(ces)"]);
  }
  public function destroyActor(string $id)
  {
    $affectedRows = Actor::destroy($id);

    return json_encode([
      "action" => "delete",
      "status" => $affectedRows > 0
    ]);
  }
}
