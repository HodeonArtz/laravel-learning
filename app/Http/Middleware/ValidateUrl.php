<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class ValidateUrl
{
  function handle(Request $request, Closure $next)
  {
    $urlRegEx =
      '/[-a-zA-Z0-9@:%_\+.~#?&=\/]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&=\/]*)?/';
    $imgUrl = $request->img_url;
    if (!preg_match($urlRegEx, $imgUrl)) {
      return redirect("/")->with("error", "La URL es inválida.");
    }
    return $next($request);
  }
}
