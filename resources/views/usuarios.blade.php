<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
</head>
<body>
    <x-navbar :logged="session('logged')" :user="session('user')" />

    <div class="contenedorMain">
        <div class="container d-flex justify-content-center gap-4 align-items-end">
            <form action="/accion" method="post">
                <div class="d-flex justify-content-center align-items-end gap-3 text-center">
                    <div class="form-group col-4">
                        <input type="hidden" name="id" {{ isset($p) ? 'value=' . $p->id . '' : '' }}>
                        <label class="col-form-label col-form-label-sm mt-4" for="inputSmall">Nombre:</label>
                        <input class="form-control form-control-sm" name="name" type="text" id="name"
                            {{ isset($p) ? 'value=' . $p->name . '' : '' }}>
                    </div>
                    <div class="form-group col-4">
                        <label class="col-form-label col-form-label-sm mt-4" for="inputSmall">Correo:</label>
                        <input class="form-control form-control-sm" name="email" type="text" id="email"
                            {{ isset($p) ? 'value=' . $p->email . '' : '' }}>
                    </div>

                    <div class="form-group col-2">
                        <label class="col-form-label col-form-label-sm mt-4" for="inputSmall">Administrador:</label>
                        <div class="form-check" style="width: 10%">
                            <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin" {{ isset($p) && $p->is_admin ? 'checked' : '' }}>
                            <span>Sí</span>
                        </div>
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
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Lista categorias --}}

                    @foreach ($usuarios as $us)
                        <tr>
                            <th scope="row">{{ $us->name }}</th>
                            <td>{{ $us->email }}</td>
                            <td><a>{{$us->is_admin}}</a></td>
                            <td>
                                <a href="/modificarUsuario/{{ $us->id }}">
                                    <i class="me-2  fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ url('/eliminarUsuario') }}/{{ $us->id }}">
                                    <i class="me-2 fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    <x-footer />
</body>

</html>
