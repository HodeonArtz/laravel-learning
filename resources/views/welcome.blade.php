@extends('layout.master')
@section('content')
  <div class="d-flex flex-column gap-5 pt-3">
    @if (!empty(session('error')))
      @include('components.error-alert', ['message' => session('error')])
    @endif

    @if (!empty($error))
      @include('components.error-alert', ['message' => $error])
    @endif
    <h1>Bienvenid@ a MyFilms!</h1>
    <section class="d-flex flex-column gap-4">
      <h2>Películas</h2>
      <div class="container">
        <div class="row" style="height:500px">
          <div id="carouselExampleAutoplaying" class="carousel slide col overflow-hidden  h-100" data-bs-ride="carousel">
            <div class="colcarousel-inner rounded overflow-hidden  h-100">
              @foreach ($films as $key => $film)
                <div class="carousel-item bg-light h-100 {{ $key === 0 ? 'active' : '' }}">
                  <h4 class="m-2 fw-normal">
                    {{ $film['name'] }}
                  </h4>
                  <img src="{{ $film['img_url'] }}" class="d-block h-100 w-100 object-fit-cover"
                    alt="{{ $film['name'] }}">
                </div>
              @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <ul class="col col-3 list-group list-group-flush">
            <li class="list-group-item ">
              <a class="link-underline-opacity-0 link-underline-opacity-75-hover  link-underline" href=/filmout/films>
                <strong>
                  Todas las pelis
                </strong>
              </a>
            </li>
            <li class="list-group-item"><a
                class="link-underline-opacity-0 link-underline-opacity-75-hover  link-underline"
                href=/filmout/newFilms>Pelis nuevas</a></li>
            <li class="list-group-item"><a
                class="link-underline-opacity-0 link-underline-opacity-75-hover  link-underline"
                href=/filmout/oldFilms>Pelis antiguas</a></li>
            <li class="list-group-item"><a
                class="link-underline-opacity-0 link-underline-opacity-75-hover  link-underline"
                href=/filmout/sortFilms>Pelis ordenadas por año</a></li>
            <li class="list-group-item"><a
                class="link-underline-opacity-0 link-underline-opacity-75-hover  link-underline"
                href=/filmout/filmsByYear/1985>Pelis del año 1985</a></li>
            <li class="list-group-item"><a
                class="link-underline-opacity-0 link-underline-opacity-75-hover  link-underline"
                href=/filmout/filmsByGenre/Drama>Pelis filtrados por género</a></li>
            <li class="list-group-item"><a
                class="link-underline-opacity-0 link-underline-opacity-75-hover  link-underline"
                href=/filmout/countFilms>¿Cuántas pelis hay en MyFilms?</a></li>
          </ul>
        </div>
      </div>
    </section>

    <hr>
    <section>
      <h2 class="mb-3">Añadir película</h2>
      <form action="/filmin/create" method="POST" class="d-flex flex-column gap-3 col-lg-4">
        @csrf
        <div>
          <label class="form-label" for="register-film-name">Nombre</label>
          <input class="form-control" required type="text" name="name" id="register-film-name"
            placeholder="Nombre de la película">
        </div>
        <div>
          <label class="form-label" for="register-film-year">Año</label>
          <input class="form-control" required type="number" min="0" name="year" id="register-film-year"
            placeholder="Año de estreno">
        </div>
        <div>
          <label class="form-label" for="register-film-genre">Género</label>
          <input class="form-control" required type="text" name="genre" id="register-film-genre"
            placeholder="Género de la película">
        </div>
        <div>
          <label class="form-label" for="register-film-country">País</label>
          <input class="form-control" required type="text" name="country" id="register-film-country"
            placeholder="País donde se ha estrenado">
        </div>
        <div>
          <label class="form-label" for="register-film-duration">Duración (min.)</label>
          <input class="form-control" required type="number" min="0" name="duration" id="register-film-duration"
            placeholder="Duración de la película en minutos">
        </div>
        <div>
          <label class="form-label" for="register-film-img-url">URL de la Imagen</label>
          <input class="form-control" required type="text" name="img_url" id="register-film-img-url"
            placeholder="URL de la imagen de la película">
        </div>
        <button type="submit" class="btn btn-primary col-lg-3">Submit</button>
      </form>
    </section>
    <hr>
    <section class="d-flex flex-column gap-4">
      <h2>Actores</h2>
      <div class="container">
        <div class="row">
          <ul class="col col-3 list-group list-group-flush">
            <li class="list-group-item"><a
                class="link-underline-opacity-0 link-underline-opacity-75-hover  link-underline"
                href=/actorout/actors><strong>Todos los actores</strong></a></li>
            <li class="list-group-item"><a
                class="link-underline-opacity-0 link-underline-opacity-75-hover  link-underline"
                href=/actorout/countActors>¿Cuántos actores hay en MyFilms?</a></li>
          </ul>
        </div>
      </div>
    </section>
  </div>
@endsection
