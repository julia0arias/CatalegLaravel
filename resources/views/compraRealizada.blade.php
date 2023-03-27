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
</head>

<body>

    <x-navbar :logged="session('logged')" :user="session('user')" :cart="session('cart', [])" :totalProductos="session('totalProductos')" />

    <div class="contenedorMain">

        <div class="container col-8 contenedorForm pt-4 d-flex justify-content-center">

            <div class="fieldLogin cardLogin p-4 m-4" style="width: 100%;">
                <h1 class="modal-title form_headingLogin text-center">¡Gracias por tu compra!</h1>
                <div class=" border-0 card_headerLogin d-flex justify-content-between">

                    <h1 class="form_headingLogin modal-title" id="loginModalLabel">Factura</h1>
                </div>
                <table class="table table-image table-hover">
                    <thead>
                      <tr>
                        <th>Producto</th>
                        <th>Precio unitario</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($carrito as $producto)
                        <tr>
                          <td>{{ $producto['nombre'] }}</td>
                          <td>{{ $producto['precio'] }} €</td>
                          <td>{{ $producto['cantidad'] }}</td>
                          <td>{{ $producto['precio'] * $producto['cantidad'] }} €</td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td>Subtotal: {{ $subtotalCompra }} €</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>IVA (21%): {{ $ivaCompra }} €</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td><strong>Total: {{ $totalCompra }} €</strong></td>
                        </tr>
                    </tfoot>
                  </table>
                    <a href="{{ url('factura') }}"><button type="button" class="btn btn-secondary">Imprimir factura</button></a>
            </div>
        </div>
        <x-footer />
</body>

</html>

