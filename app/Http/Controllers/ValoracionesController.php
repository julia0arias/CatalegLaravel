<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Valoracion;
use Illuminate\Http\Request;
class ValoracionesController extends Controller
{

    public function anadirValoracion(Request $request){
            $valoracion = new Valoracion;
            $valoracion->valoracion = $request->valoracion;
            $valoracion->producto_id = $request->producto_id;
            $valoracion->user_id = $request->user_id;

            $valoracion->save();
            return redirect('/productos')->withErrors(['nombre' => 'Reseña publicada correctamente.']);;
        }

    public function obtenerValoraciones($producto_id){
        $valoraciones = Valoracion::where('producto_id', $producto_id)->get();
        return view('valoraciones', ['valoraciones' => $valoraciones]);
    }
}

?>
