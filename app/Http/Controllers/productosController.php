<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Validator;

class productosController extends Controller
{
    public function show()
    {
        $producto = Producto::all();
        $categorias = Categoria::all();
        return view("productos", ['productos' => $producto, 'categorias' => $categorias]);
    }

    public function delete(Request $r)
    {
        $producto = Producto::find($r->id);
        $producto->delete();
        return redirect('/productos');
    }


    public function accion(Request $request)
    {

        if ($request->id != false) {
            $producto = $this->buscarProducto($request->id);
            $this->modificarProducto($request, $producto);
        } else {
            $this->guardarProducto($request);
        }
        return redirect()->to("/productos");
    }

    public function guardarProducto($request)
    {

        $producto = new Producto();
        if($request->nombre != null){
            $producto->nombre = $request->nombre;
        } else {
            return back()->withErrors(['nombre' => 'Añada un nombre al producto.']);
        }

        $producto->categoria_id = $request->categoria_id;
        $producto->descripcion = $request->descripcion;

        if ($request->hasFile('imagen')) {
            $name = $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->storeAs('public', $name, 'local');
            $producto->imagen = $name;
        } else {
            return back()->withErrors(['imagen' => 'Añada una imagen al producto.']);
        }

        $producto->save();

    }
    public function modificarProducto($request, $producto)
    {
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;

        if ($request->hasFile('imagen')) {
            $name = $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->storeAs('public', $name, 'local');
            $producto->imagen = $name;
        }

        $producto->categoria_id = $request->categoria_id;
        $producto->save();
    }

    public function buscarProducto($id)
    {
        return Producto::where('id', $id)->first();
    }

    public function subirDatos($id)
    {
        $p = Producto::find($id);
        $listaProductos = Producto::all();
        $categorias = Categoria::all();

        return view('/productos', ['p' => $p, 'productos' => $listaProductos, 'categorias' => $categorias]);
    }
}
