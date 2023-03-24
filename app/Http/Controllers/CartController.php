<?php

namespace App\Http\Controllers;


use App\Models\Producto;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $totalProductos = 0;
        $productoId = $request->input('id');
        $producto = Producto::find($productoId);

        // Obtener el carrito de compras actual desde la sesión
        $cart = session('cart', []);

        // Verificar si el producto ya está en el carrito
        if (array_key_exists($productoId, $cart)) {
            // Si el producto ya está en el carrito, incrementar la cantidad
            $cart[$productoId]['cantidad'] += 1;
        } else {
            // Si el producto no está en el carrito, agregarlo con una cantidad de 1
            $cart[$productoId] = [
                'id' => $productoId,
                'nombre' => $producto->nombre,
                'descripcion' => $producto->descripcion,
                'imagen' => $producto->imagen,
                'precio' => $producto->precio,
                'cantidad' => 1
            ];
        }

        // Almacenar el carrito actualizado en la sesión
        session(['cart' => $cart]);

        // Obtener la cantidad total de productos en el carrito
        foreach ($cart as $producto) {
            $totalProductos += $producto['cantidad'];
        }

        // Almacenar el total de productos en sesión
        session(['totalProductos' => $totalProductos]);

        // Redirigir al usuario a la página del producto
        return redirect()->intended('productos');
    }


    public function checkout()
    {
         session(['cart' => []]);
        //$cart = session('cart', []);

        session(['totalProductos' => 0]);
        // Calcular el total de la compra
        /*$total = 0;
        foreach ($cart as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }*/

        // Mostrar la vista de confirmación de compra
      /*  return view('checkout')->with([
            'cart' => $cart,
            'total' => $total
        ]);*/
        return redirect()->intended('productos');
    }
}
