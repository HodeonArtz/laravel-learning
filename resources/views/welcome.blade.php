@extends("layout.master")
@section("content")
<div class="d-flex flex-column gap-5 pt-3">
  @if(session("error"))
  @include('components.error-alert', ["message" => session("error")])
  @endif

  @if(!empty($error))
  @include('components.error-alert', ["message" => $error])
  @endif
  <h1>Bienvenid@ a MyFilms!</h1>
  <section>
    <h2>Películas</h2>
    <ul>
      <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
      <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
      <li><a href=/filmout/films>Pelis</a></li>
      <li><a href=/filmout/filmsByGenre/Drama>Pelis por género</a></li>
      <li><a href=/filmout/filmsByYear/1985>Pelis por año</a></li>
      <li><a href=/filmout/sortFilms>Pelis ordenadas por año</a></li>
      <li><a href=/filmout/countFilms>¿Cuántas pelis hay?</a></li>
    </ul>
  </section>
    <section >
      <h2 class="mb-3">Añadir película</h2>
      <form action="/filmin/create" method="POST" class="d-flex flex-column gap-3 col-lg-4">
        @csrf
        <div>
          <label class="form-label" for="register-film-name">Nombre</label>
          <input class="form-control" type="text" name="name" id="register-film-name" placeholder="Nombre de la película">
        </div>
        <div>
          <label class="form-label" for="register-film-year">Año</label>
          <input class="form-control" type="number" min="0"  name="year" id="register-film-year" placeholder="Año de estreno">
        </div>
        <div>
          <label class="form-label" for="register-film-genre">Género</label>
          <input class="form-control" type="text" name="genre" id="register-film-genre" placeholder="Género de la película">
        </div>
        <div>
          <label class="form-label" for="register-film-country">País</label>
          <input class="form-control" type="text" name="country" id="register-film-country" placeholder="País donde se ha estrenado">
        </div>
        <div>
          <label class="form-label" for="register-film-duration">Duración (min.)</label>
          <input class="form-control" type="number" min="0"  name="duration" id="register-film-duration" placeholder="Duración de la película en minutos">
        </div>
        <div>
          <label class="form-label" for="register-film-img-url">URL de la Imagen</label>
          <input class="form-control" type="text" name="img_url" id="register-film-img-url" placeholder="URL de la imagen de la película">
        </div>
        <button type="submit" class="btn btn-primary col-lg-3">Submit</button>
    </section>
</div>
@endsection