<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class ValidateUrl
{
  function handle(Request $request, Closure $next)
  {
    $imgUrl = $request->img_url;
    if (!filter_var($imgUrl, FILTER_VALIDATE_URL)) {
      return redirect("/")->with("error", "La URL $imgUrl es inválida.");
    }
    return $next($request);
  }
}
