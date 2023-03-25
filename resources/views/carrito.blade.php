<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrito</title>
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
        <div class="container col-8 contenedorForm pt-4 d-flex justify-content-center">
            <form method="POST" style="width: 900px;" class="formLogin cardLogin" action="">
                @csrf
                <div class=" border-0 card_headerLogin d-flex justify-content-between">
                    <h1 class="form_headingLogin modal-title" id="loginModalLabel">Tu cesta</h1>
                </div>
                <div class="fieldLogin">
                    @if (count(session('cart', [])) > 0)

                        <table class="table table-image">
                            <thead>
                                <tr>
                                    <th>Productos</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            @foreach (session('cart', []) as $producto)
                                <tr data-product-id="{{ $producto['id'] }}">
                                <tr>
                                    <td class="w-25">
                                        <img src="{{ asset('storage/' . $producto['imagen']) }}"
                                            class="img-fluid img-thumbnail" alt="Sheep">
                                        {{ $producto['nombre'] }}
                                    </td>
                                    <td class="precio-producto">{{ $producto['precio'] }}</td>
                                    <td>
                                        <div class="input-group w-3">
                                            <a href="{{ route('cart.decrement', ['id' => $producto['id']]) }}"
                                                onclick="decrementAmount(this)" type="button"
                                                class="btn btn-outline-secondary decrement-btn m-0"
                                                data-id="{{ $producto['id'] }}">-</a>
                                            <input type="text" class="form-control qty-input inputLogin"
                                                id="qty-input_{{ $producto['id'] }}"
                                                name="qty-input_{{ $producto['id'] }}"
                                                value="{{ $producto['cantidad'] }}" readonly>
                                            <a href="{{ route('cart.increment', ['id' => $producto['id']]) }}"
                                                onclick="incrementAmount(this)" type="button"
                                                class="btn btn-outline-secondary increment-btn m-0"
                                                data-id="{{ $producto['id'] }}">+</a>
                                        </div>
                                    </td>
                                    <td class="total-product">{{ $producto['precio'] * $producto['cantidad'] }}</td>
                                    <td><a href="{{ route('cart.delete', ['id' => $producto['id']]) }}"><i class="fa-solid fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>Aún no ha añadido productos a la cesta.</p>
                    @endif
                    <div class="d-flex justify-content-end text-dark">
                        <div class="d-flex justify-content-end text-dark">
                            <h5>Total compra: <span class="price" id="totalPrice">{{ $totalCompra }}</span>€</h5>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-end gap-4">
                    @if ($errors->any())
                        <div class="alert alert-success alertas">
                            <ul style="margin:0.2px;">
                                @foreach ($errors->all() as $error)
                                    <li style="font-size: 0.8em;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
        <div class="border-0 d-flex justify-content-between fieldLogin">
            <a href="{{ url('/productos') }}"><button type="button" class="btn btn-secondary">Seguir
                    comprando</button></a>
            <a href="{{ route('cart.checkout') }}"><button type="button" class="btn btn-success" onclick="">Comprar</button></a>
        </div>
    </div>
    </div>
    </form>

    <x-footer />

    </div>

</body>

</html>
