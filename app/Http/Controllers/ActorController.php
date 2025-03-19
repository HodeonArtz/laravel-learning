<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
  public function listAllActors()
  {
    // use json_encode and json_decode to transform object to associative array
    $actors = json_decode(json_encode(DB::table("actors")->get()->toArray()), true);

    return view("components.list", ["elements" => $actors, "title" => "Listado de todos los actores"]);
  }
  public function countActors()
  {
    $actorCount = DB::table("actors")->count();
    return view("components.message", ["title" => "Actores", "message" => "Actualmente hay $actorCount actor(es)/actriz(ces)"]);
  }
}
