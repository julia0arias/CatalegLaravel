<?php

namespace App\Http\Controllers;


use App\Models\Producto;
use Illuminate\Http\Request;
use TCPDF;

class CartController extends Controller
{

    private function actualizarCarrito($productoId, $cantidad) {
        $producto = Producto::find($productoId);
        $cart = session('cart', []);

        if ($cantidad <= 0) {
            unset($cart[$productoId]);
        } else {
            $productoActualizado = [
                'id' => $productoId,
                'nombre' => $producto->nombre,
                'descripcion' => $producto->descripcion,
                'imagen' => $producto->imagen,
                'precio' => $producto->precio,
                'cantidad' => $cantidad
            ];
            $cart[$productoId] = $productoActualizado;
        }

        session(['cart' => collect($cart)]);
        $this->cantidadProductos($cart);
    }

    public function addToCart(Request $request)
    {
        $productoId = $request->input('id');
        $cart = collect(session('cart', []));

        if ($cart->has($productoId)) {
            $this->incrementAmount($productoId);
        } else {
            $this->actualizarCarrito($productoId, 1);
        }

        return redirect()->intended('productos')->withErrors(['nombre' => 'Producto añadido al carrito.']);
    }

    public function incrementAmount($productoId)
    {
        $cart = session('cart', []);
        $cantidad = $cart[$productoId]['cantidad'] + 1;
        $this->actualizarCarrito($productoId, $cantidad);
        return redirect()->back();
    }

    public function decrementAmount($productoId)
    {
        $cart = session('cart', []);
        $cantidad = $cart[$productoId]['cantidad'] - 1;
        $this->actualizarCarrito($productoId, $cantidad);
        return redirect()->back();
    }

    public function deleteProduct($productoId)
    {
        $this->actualizarCarrito($productoId, 0);
        return redirect()->back();
    }

    public function cantidadProductos($cart)
    {
        $totalProductos = 0;

        foreach ($cart as $producto) {
            $totalProductos += $producto['cantidad'];
        }

        session(['totalProductos' => $totalProductos]);
    }

  /*  public function calcularPrecioTotal() {
        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }

        session(['totalCompra' => $total]);
    }*/

    public function calcularPrecioTotal($cart) {
        $subtotal = 0;

        foreach ($cart as $producto) {
            $subtotal += number_format($producto['precio'] * $producto['cantidad'], 2, '.', '');
        }

        $iva = number_format($subtotal * 0.21, 2, '.', '');
        $total = number_format($subtotal + $iva, 2, '.', '');

        session(['subtotalCompra' => $subtotal, 'ivaCompra' => $iva, 'totalCompra' => $total]);

        return $total;
    }

    public function checkout()
    {
        $totalProductos = session('totalProductos', 0);
        $carrito = session('cart', []);

        if ($totalProductos > 0) {
            $totalCompra = $this->calcularPrecioTotal($carrito);
            session(['datosFactura' => [
                'carrito' => $carrito,
                'totalCompra' => $totalCompra,
            ]]);

            return redirect('stripe');

        } else {
            return redirect()->back()->withErrors(['mensaje' => 'No hay productos en el carrito para comprar.']);
        }
    }

    public function mostrarCarrito()
    {
        $carrito = collect(session('cart', []));
        $totalCompra = $this->calcularPrecioTotal($carrito->toArray());

        if (session('datosFactura') === null) {
            session(['datosFactura' => compact('carrito', 'totalCompra')]);
        }

        $this->cantidadProductos($carrito);

        return view('/carrito', ['carrito' => $carrito, 'totalCompra' => $totalCompra]);
    }

}
