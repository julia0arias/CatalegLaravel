<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ url('/') }}"> <i class="fa-brands fa-napster brand"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03"
                aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
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
        <div class="container">
            <form action="/anadirProducto" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-center align-items-end gap-4">
                    <div class="form-group">
                        @csrf
                        <input type="hidden" name="id" {{ isset($p) ? 'value=' . $p->id . '' : '' }}>
                        <label class="col-form-label col-form-label-sm mt-4" for="nombre">Nombre:</label>
                        <input class="form-control form-control-sm" name="nombre" type="text" id="nombre"
                            {{ isset($p) ? 'value=' . $p->nombre . '' : '' }} required>
                    </div>
                    <div class="form-group col-2">
                        <label class="col-form-label col-form-label-sm mt-4" for="descripcion">Descripcion:</label>
                        <input class="form-control form-control-sm" name="descripcion" type="text" id="descripcion"
                            {{ isset($p) ? 'value=' . $p->descripcion . '' : '' }}>
                    </div>
                    <div class="form-group col-2 ">
                        <label for="categoria_id" class="col-form-label col-form-label-sm mt-4">Categoria:</label>
                        <select class="form-select" id="categoria_id" name="categoria_id" required>
                            @foreach ($categorias as $categoria)
                                <option name="categoria_id" value="{{ $categoria->id }}">{{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label class="col-form-label col-form-label-sm mt-4" for="imagen">Imagen:</label>
                        <input class="form-control form-control-sm" name="imagen" type="file" id="imagen"
                            required>
                    </div>
                    <button type="submit" class="boton">Guardar</button>
                </div>
            </form>
            <div class="d-flex justify-content-center align-items-end gap-4">
                @if ($errors->any())
                    <div class="alert alert-danger alertas">
                        <ul style="margin:0.2px;">
                            @foreach ($errors->all() as $error)
                                <li style="font-size: 0.8em;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="container contenedorProductos gap-2">

            @foreach ($productos as $prod)
                <div class="card shadow-sm" style="width: 300px;">

                    <img src="{{ asset('storage/' . $prod->imagen) }}" class="card-img-top" alt="Imagen del producto">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre: {{ $prod->nombre }}</h5>
                        <p class="card-text">Descripcion: {{ $prod->descripcion }}</p>
                        @foreach ($categorias as $categoria)
                            @if ($prod->categoria_id == $categoria->id)
                                <p class="card-text">Categoria: {{ $categoria->nombre }}</p>
                            @endif
                        @endforeach
                        <a href="/modificar/{{ $prod->id }}"><i class="me-2  fa-solid fa-pen-to-square"></i></a>
                        <a href="{{ url('/eliminar') }}/{{ $prod->id }}"><i
                                class="me-2 fa-solid fa-trash"></i></a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                        <svg class="bi" width="30" height="24">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>
                    <span class="text-muted">© 2021 Company, Inc</span>
                </div>

                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24"
                                height="24">
                                <use xlink:href="#twitter"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24"
                                height="24">
                                <use xlink:href="#instagram"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24"
                                height="24">
                                <use xlink:href="#facebook"></use>
                            </svg></a></li>
                </ul>
            </footer>
        </div>
    </div>
</body>

</html>
