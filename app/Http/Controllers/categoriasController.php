<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\Producto;

class categoriasController extends Controller
{
    public function addCategoria(Request $r)
    {
        $categoria = new Categoria;
        $categoria->nombre = $r->nombre;
        $categoria->descripcion = $r->descripcion;
        $categoria->save();
        return redirect('/show');
    }

    //nos envia a la pagina que muestra todas las peliculas
    public function show()
    {
        $categorias = Categoria::withCount('productos')->get();

        return view("categorias", ['categorias' => $categorias]);
    }

    public function delete(Request $r)
    {
        try {
            $categoria = Categoria::find($r->id);
            $categoria->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withErrors(['error' => 'No se puede eliminar una categoria que tiene productos asociados.']);
        }

        return redirect('/categorias');
    }

    public function accion(Request $request)
    {

        if ($request->id != false) {
            $categoria = $this->buscarCategoria($request->id);
            $this->modificarCategoria($request, $categoria);
        } else {
            $this->guardarCategoria($request);
        }
        return redirect()->to("/categorias");

    }

    public function guardarCategoria($request)
    {
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
    }

    public function modificarCategoria($request, $categoria)
    {
        /*  Categoria::where('id', $request->id)->first()->update(['nombre'
        => $request->nombre, 'descripcion' => $request->descripcion]); */
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
    }
    public function buscarCategoria($id)
    {
        return Categoria::where('id', $id)->first();
    }
    public function subirDatos($id)
    {
        $p = Categoria::find($id);
        $listaCategorias = Categoria::all();
        //return redirect()->route('/', ['p' => $p, 'listaPersonas' => $listaPersonas]);
        return view('/categorias', ['p' => $p], ['categorias' => $listaCategorias]);
    }
}
