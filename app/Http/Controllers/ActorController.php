<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
  public function countActors()
  {
    $actorCount = DB::table("actors")->count();
    return view("actors.message", ["message" => "Actualmente hay $actorCount actor(es)/actriz(ces)"]);
  }
}
