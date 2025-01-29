<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
  function handle(Request $request, Closure $next)
  {
    $urlRegEx =
      "/[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/";
    $imgUrl = $request->route("film-img-url");
    if (!preg_match($urlRegEx, $imgUrl)) {
      redirect("/")->with("error", "La URL es inválida.");
    }
    return $next($request);
  }
}
