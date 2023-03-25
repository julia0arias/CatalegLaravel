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

    <x-navbar :logged="session('logged')" :user="session('user')" :cart="session('cart', [])" :totalProductos="session('totalProductos')" />

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

    <x-footer />

</div>
</body>
</html>
