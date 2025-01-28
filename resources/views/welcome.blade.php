@extends("layout.master")
@section("content")
    <h1 class="mt-4">Lista de Peliculas</h1>
    <ul>
        <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
        <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
        <li><a href=/filmout/films>Pelis</a></li>
        <li><a href=/filmout/filmsByGenre/Drama>Pelis por género</a></li>
        <li><a href=/filmout/filmsByYear/1985>Pelis por año</a></li>
        <li><a href=/filmout/sortFilms>Pelis ordenadas por año</a></li>
        <li><a href=/filmout/countFilms>¿Cuántas pelis hay?</a></li>
    </ul>
    
@endsection