<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
</head>
<body>
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
              <li class="nav-item">
                <a class="nav-link menu" href="{{ url('/contacto') }}">Contacto</a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu" href="{{ url('/register') }}">Registrarse</a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu" href="{{ url('/login') }}">Log in</a>
              </li>
            </ul>
            <form action="/login">
                <input type="text" name="user" placeholder="Usuario">
                <input type="password" name="password" placeholder="Contraseña">
                <button class="btn btn-primary boton me-5 mx-2" type="submit" value="validar">Loguear</button>
            </form>
          </div>
        </div>
      </nav>
      <div class="contenedorMain">
        <div class="container col-4 contenedorForm pt-4 d-flex justify-content-center">
          <form class="formLogin cardLogin" method="POST" action="{{ route('register') }}">
              @csrf
              <div class="card_headerLogin">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path fill="none" d="M0 0h24v24H0z"></path>
                  <path fill="currentColor" d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z"></path>
                </svg>
                <h1 class="form_headingLogin">Log in</h1>
              </div>
              <div class="fieldLogin">
                <label for="username">Username</label>
                <input class="inputLogin" name="name" type="text" placeholder="Username" id="username">
              </div>
              <div class="fieldLogin">
                <label for="password">Password</label>
                <input class="inputLogin" name="password" type="password" placeholder="Password" id="password">
              </div>
              <div class="fieldLogin">
                <button class="button">Login</button>
              </div>
            </form>
      </div>

<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
          <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
        </a>
        <span class="text-muted">© 2021 Company, Inc</span>
      </div>

      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
      </ul>
    </footer>
  </div>
</div>
</body>
</html>
