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
            'name' => 'required|string',
            'password' => 'required',
        ]);
         $credentials = $request->only('name', 'password');
         if(Auth::attempt($credentials)){
            $user = User::where('name', request()->name)->first();

            $request->session()->put('isAdmin', $user->is_admin === 'S' ? true : false);
            $request->session()->put('logged', true);
            $request->session()->put('user', $user);

          //  $user->createToken('isAdmin', $user->is_admin === 'S' ? true : false);
          //  $user->createToken('logged', true);
          //  $request->session()->put('token', $user->getTokens());

            $request->session()->regenerate();
            return redirect()->intended();
         }
         return redirect()->intended('login')->withSuccess('Oppes! You have entered invalid credentials');
    }

    final public function logout()
    {
        session()->forget('isAdmin');
        session()->forget('logged');
        session()->forget('user');
        session()->flush();
        return redirect()->intended('/');
    }

    final public function register(Request $request){

        $validateUser = Validator::make($request->all(),
        [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if($validateUser->fails()){
            return redirect()->intended('register')->withSuccess('Oppes! You have entered invalid credentials');
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return redirect()->intended('/login');
        }
    }
}
