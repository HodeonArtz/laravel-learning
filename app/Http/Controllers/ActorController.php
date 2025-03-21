<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
  public function listActors()
  {
    // use json_encode and json_decode to transform object to associative array
    $actors = json_decode(json_encode(DB::table("actors")->get()->toArray()), true);

    return view("components.list", ["elements" => $actors, "title" => "Listado de todos los actores"]);
  }
  public function listActorsByDecade(int $decade)
  {
    $decadeStart = Carbon::create($decade, 1, 1)->startOfYear();
    $decadeEnd = Carbon::create($decade + 9, 12, 31)->endOfYear();

    $actors = json_decode(json_encode(DB::table("actors")->whereBetween("birthdate", [$decadeStart, $decadeEnd])->get()->toArray()), true);
    return view("components.list", ["elements" => $actors, "title" => "Listado de actores filtrado por década"]);
  }
  public function countActors()
  {
    $actorCount = DB::table("actors")->count();
    return view("components.message", ["title" => "Actores", "message" => "Actualmente hay $actorCount actor(es)/actriz(ces)"]);
  }
}