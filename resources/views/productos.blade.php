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

    <x-navbar :logged="session('logged')" :user="session('user')" :cart="session('cart', [])" :totalProductos="session('totalProductos')" />

    <div class="contenedorMain">

        <div class="container">

            @if (session('logged') != null && session('isAdmin') != null)
            <form action="/anadirProducto" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-center align-items-end flex-wrap gap-4">
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
                    <div class="form-group col-2">
                        <label class="col-form-label col-form-label-sm mt-4" for="descripcion">Precio:</label>
                        <input class="form-control form-control-sm" name="precio" type="number" step="0.01"
                            id="precio" {{ isset($p) ? 'value=' . $p->precio . '' : '' }}>
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
            @else
            <div class="p-3"></div>
            @endif
        </div>

        <div class="d-flex justify-content-center align-items-end gap-4">
            @if ($errors->any())
                <div class="alert alert-primary alertas">
                    <ul style="margin:0.2px;">
                        @foreach ($errors->all() as $error)
                            <li style="font-size: 0.8em;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="container contenedorProductos gap-2">

            @foreach ($productos as $prod)

                <div class="card shadow-sm" style="width: 300px;">

                    <img src="{{ asset('storage/' . $prod->imagen) }}" class="card-img-top" alt="Imagen del producto">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre: {{ $prod->nombre }}</h5>
                        <p class="card-text">Descripcion: {{ $prod->descripcion }}</p>
                        <p class="card-text">Precio: {{ $prod->precio }}</p>
                        @foreach ($categorias as $categoria)
                            @if ($prod->categoria_id == $categoria->id)
                                <p class="card-text">Categoria: {{ $categoria->nombre }}</p>
                            @endif
                        @endforeach
                        @if (session('isAdmin') != null && session('isAdmin'))
                            <a href="/modificar/{{ $prod->id }}"><i
                                    class="me-2  fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ url('/eliminar') }}/{{ $prod->id }}"><i
                                    class="me-2 fa-solid fa-trash"></i></a>
                        @endif
                        <div class="anadirCarrito">
                            @if (session('logged') != null && session('isAdmin') == false)
                                <form method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $prod->id }}">
                                    <button class="anadirCarrito" title="Añadir al carrito">
                                        <i class="fa-solid fa-basket-shopping"></i>
                                        <span class='badgePlus' id='lblCartCount'> + </span>
                                    </button>
                                </form>
                                <button href="#valoracionModal" class="btn btn-primary mt-4 boton" data-bs-toggle="modal" data-bd-target="#valoracionModal">Valorar producto</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <x-footer />
        <x-valoracionModal/>
    </div>
</body>

</html>
