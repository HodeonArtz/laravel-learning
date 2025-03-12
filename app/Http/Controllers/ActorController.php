<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
  public function countActors()
  {
    $actorCount = DB::table("actors")->count();
    return view("components.message", ["title" => "Actores", "message" => "Actualmente hay $actorCount actor(es)/actriz(ces)"]);
  }
}
