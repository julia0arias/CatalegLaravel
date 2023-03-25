<?php

namespace App\Http\Controllers;


use App\Models\Producto;
use Illuminate\Http\Request;

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

    public function calcularPrecioTotal() {
        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }

        session(['totalCompra' => $total]);
    }

    public function checkout()
    {
        $totalProductos = session('totalProductos', 0);
        if ($totalProductos > 0) {
            session(['cart' => []]);
            session(['totalProductos' => 0]);
            return redirect()->back()->withErrors(['mensaje' => '¡Gracias por tu compra!']);
        } else {
            return redirect()->back()->withErrors(['mensaje' => 'No hay productos en el carrito para comprar.']);
        }
    }

    public function mostrarCarrito()
    {
        $carrito = collect(session('cart', []));
        $totalCompra = session('totalCompra', $this->calcularPrecioTotal());
        return view('/carrito', ['carrito' => $carrito, 'totalCompra' => $totalCompra]);
    }


}
