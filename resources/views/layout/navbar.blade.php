<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid container justify-content-end">
    <button class="navbar-toggler align-self-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ URL::to('/img/film-reel-icon.webp') }}"
          style="width: 32px !important; aspect-ratio: 1/1;" alt="logo"> MyFilms</a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('index') }}">Inicio</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
