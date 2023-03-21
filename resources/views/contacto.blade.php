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
              @if (session('logged') == null)
              <li class="nav-item">
                <a class="nav-link menu" href="{{ url('/login') }}">Log in</a>
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
<div class="contenedorMain">
      <div class="container col-4 contenedorForm pt-4">
      <form class="formulario">

        <div class="form-group col-5">
            <label for="nombre" class="form-label mt-1">Nombre</label>
            <input type="text" class="form-control" id="inputNombre" placeholder="Nombre">
            <label for="apellido" class="form-label mt-4">Apellidos</label>
            <input type="text" class="form-control" id="inputApellidos" placeholder="Apellidos">
          </div>
          <div class="form-group col-5">
            <label for="exampleInputEmail1" class="form-label mt-4">Correo</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>

          <div class="form-group">
            <label for="exampleTextarea" class="form-label mt-4">Comentarios</label>
            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary mt-4 boton enviar">Enviar</button>
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
