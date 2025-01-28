<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include("layout.head")
  <title>MyFilms - @yield("title", "Look up and search for your favourite films!")</title>
</head>
<body>
@include('layout.navbar')
<main class="container pt-4">
  @yield("content")
</main>
@include('layout.footer')
</body>
</html>