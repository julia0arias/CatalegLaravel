<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\productosController;
use App\Http\Controllers\categoriasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos', function () {
    return view('productos');
});

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/productos', [productosController::class, 'show']);

Route::get('/categorias', [categoriasController::class, 'show']);

//Para gente logueada
//Route::middleware(['auth:sanctum'])->group(function () {

//Route::get('/categorias', [CategoriasController::class, 'show']);

//});

//Categorias
Route::get('/eliminarCategoria/{id}', [categoriasController::class, 'delete']);

Route::get('/modificarCategoria/{id}', [categoriasController::class, 'subirDatos']);

Route::post('/accion', [categoriasController::class, 'accion']);

//Productos

Route::get('/eliminar/{id}', [productosController::class, 'delete']);

Route::get('/modificar/{id}', [productosController::class, 'subirDatos']);

Route::post('/anadirProducto', [productosController::class, 'accion']);

//Logins

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/userRegister', [AuthController::class, 'register'])->name('userRegister');
/*Route::get('/register', [usersController::class, 'form']);
Route::post('/login', [usersController::class, 'login']);*/
