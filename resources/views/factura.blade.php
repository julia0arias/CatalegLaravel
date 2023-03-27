<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        .btn-info {
            height: 40px;
        }
    </style>
</head>

<body>
    <h1>Factura</h1>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio unitario</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrito as $producto)
            <tr>
                <td>{{ $producto['nombre'] }}</td>
                <td>{{ $producto['precio'] }}€</td>
                <td>{{ $producto['cantidad'] }}</td>
                <td>{{ $producto['precio'] * $producto['cantidad'] }}€</td>
            </tr>
            @endforeach
        </tbody>
                <tfoot class="mt-4">
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
</body>

</html>
