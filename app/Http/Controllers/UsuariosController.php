<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
class UsuariosController extends Controller
{
    public function show()
{
    $usuarios = User::all();
    return view("usuarios", ['usuarios' => $usuarios]);

}

public function delete(Request $r)
{
    try {
        $usuario = User::find($r->id);
        $usuario->delete();
    } catch (\Illuminate\Database\QueryException $e) {
        return back()->withErrors(['error' => 'No se puede eliminar el usuario.']);
    }

    return redirect('/usuarios');
}

public function accion(Request $request)
{

    if ($request->id != false) {
        $usuario = $this->buscarUsuario($request->id);
        $this->modificarUsuario($request, $usuario);
    } else {
        $this->guardarUsuario($request);
    }
    return redirect()->to("/usuarios");

}

public function guardarUsuario($request)
{
    $usuario = new User();
    $usuario->name = $request->name;
    $usuario->email = $request->email;
    $usuario->password = $request->password;
    $usuario->save();
}

public function modificarUsuario($request, $usuario)
{
    $usuario->name = $request->name;
    $usuario->email = $request->email;
    $usuario->password = $request->password;
    $usuario->save();
}
public function buscarUsuario($id)
{
    return User::where('id', $id)->first();
}
public function subirDatos($id)
{
    $p = User::find($id);
    $listaUsuarios = User::all();
    //return redirect()->route('/', ['p' => $p, 'listaPersonas' => $listaPersonas]);
    return view('/usuarios', ['p' => $p], ['usuarios' => $listaUsuarios]);
}

}
