<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
  function handle(Request $request, Closure $next)
  {
    $urlRegEx =
      '/\b(?:https?|ftp):\/\/(?:www\.)?[\w-]+\.[a-z]{2,6}(?:\/[\w\-\?&=%#\.]*)?\b/i ';
    $imgUrl = $request->route("film-img-url");
    if (!preg_match($urlRegEx, $imgUrl)) {
      redirect("/")->with("error", "La URL es inválida.");
    }
    return $next($request);
  }
}
