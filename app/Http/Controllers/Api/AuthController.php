<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
final class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    final public function login(Request $request)
    {
        request()->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);
         $credentials = $request->only('email', 'password');
         if(Auth::attempt($credentials)){
            $user = User::where('email', request()->email)->first();

            $request->session()->put('isAdmin', $user->is_admin === 'S' ? true : false);
            $request->session()->put('logged', true);
            $request->session()->put('user', $user);

          //  $user->createToken('isAdmin', $user->is_admin === 'S' ? true : false);
          //  $user->createToken('logged', true);
          //  $request->session()->put('token', $user->getTokens());

            $request->session()->regenerate();
            return redirect()->intended();
         }
         return redirect()->intended()->withSuccess('Error al registrarse');
    }

    final public function logout()
    {
        session()->forget('isAdmin');
        session()->forget('logged');
        session()->forget('user');
        session()->flush();
        return redirect()->intended();
    }

    final public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ], [
            'email.email' => 'El correo electrónico no es válido.'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 'N'
        ]);

        return redirect()->intended();
    }

}
