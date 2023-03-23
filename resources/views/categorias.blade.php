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
    <style>
        .btn-info {
            height: 40px;
        }
    </style>
</head>

<body>

    <x-navbar :logged="session('logged')" :user="session('user')" :cart="session('cart', [])" :totalProductos="session('totalProductos')" />

    <div class="contenedorMain">
        <div class="container d-flex justify-content-center gap-4 align-items-end">
            <form action="/accion" method="post">
                <div class="d-flex justify-content-center align-items-end gap-3">
                    @csrf
                    <div class="form-group col-4">
                        <input type="hidden" name="id" {{ isset($p) ? 'value=' . $p->id . '' : '' }}>
                        <label class="col-form-label col-form-label-sm mt-4" for="inputSmall">Nombre:</label>
                        <input class="form-control form-control-sm" name="nombre" type="text" id="nombre"
                            {{ isset($p) ? 'value=' . $p->nombre . '' : '' }}>
                    </div>
                    <div class="form-group col-4">
                        <label class="col-form-label col-form-label-sm mt-4" for="inputSmall">Descripcion:</label>
                        <input class="form-control form-control-sm" name="descripcion" type="text" id="descripcion"
                            {{ isset($p) ? 'value=' . $p->descripcion . '' : '' }}>
                    </div>
                    <button type="submit" class="boton">Guardar</button>
                </div>
            </form>
        </div>
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
        <div class="container">
            <table class="table table-hover table-light m-5">
                <thead>
                    <tr class="table-active">
                        <th scope="col">Categoría</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Discos</th>
                        @if (session('isAdmin') != null && session('isAdmin'))
                            <th scope="col">Acciones</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    {{-- Lista categorias --}}

                    @foreach ($categorias as $cat)
                        <tr>
                            <th scope="row">{{ $cat->nombre }}</th>
                            <td>{{ $cat->descripcion }}</td>

                            {{-- Contar productos por categoria --}}
                            <td><a>{{$cat->productos_count}}</a></td>
                            <!-- redirigir a productos con esas categorias-->
                            @if (session('isAdmin') != null && session('isAdmin'))
                            <td>
                                <a href="/modificarCategoria/{{ $cat->id }}">
                                    <i class="me-2  fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ url('/eliminarCategoria') }}/{{ $cat->id }}">
                                    <i class="me-2 fa-solid fa-trash"></i>
                                </a>
                            </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
            </table>
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
                    <li class="ms-3">
                        <a class="text-muted" href="#">
                            <svg class="bi" width="24" height="24">
                                <use xlink:href="#twitter"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="ms-3">
                        <a class="text-muted" href="#">
                            <svg class="bi" width="24" height="24">
                                <use xlink:href="#instagram"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="ms-3">
                        <a class="text-muted" href="#">
                            <svg class="bi" width="24" height="24">
                                <use xlink:href="#facebook"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </footer>
        </div>
    </div>
</body>

</html>
