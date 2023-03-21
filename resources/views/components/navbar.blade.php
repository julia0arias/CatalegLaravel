@props(['logged' => null, 'user' => null])

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

      <a class="navbar-brand" href="{{ url('/') }}"> <i class="fa-brands fa-napster brand"></i></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active menu" href="{{ url('/') }}">Home
              <span class="visually-hidden">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu" href="{{ url('/productos') }}">Discos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu" href="{{ url('/categorias') }}">Categorías</a>
          </li>
          @if (session('isAdmin') != null && session('isAdmin'))
          <li class="nav-item">
            <a class="nav-link menu" href="{{ url('/usuarios') }}">Usuarios</a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link menu" href="{{ url('/contacto') }}">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link menu" href="{{ url('/register') }}">Registrarse</a>
          </li>
          @if (session('logged') == null)
          <li class="nav-item">
            <a class="nav-link menu" href="{{ url('/login') }}" data-toggle="modal" data-target="#loginModal">Log in</a>
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login</button> -->
          </li>

          @else

          <li class="nav-item">
            <a class="nav-link menu" href="{{ url('/logout') }}">Cerrar sesión</a>
          </li>
          @endif

        </ul>
        @if (session('logged') != null)
        <p></p>
        <p class="userName">Bienvenido {{ session('user')->name }} !</p>
        @endif
      </div>
    </div>
  </nav>
