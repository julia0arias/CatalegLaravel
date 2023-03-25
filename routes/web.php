<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\productosController;
use App\Http\Controllers\categoriasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CartController;

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


// Crud usuarios

Route::post('/accionUsuarios', [UsuariosController::class, 'accion']);

// Logins

Route::get('/usuarios', [UsuariosController::class, 'show']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/eliminarUsuario/{id}', [UsuariosController::class, 'delete']);
Route::get('/modificarUsuario/{id}', [UsuariosController::class, 'subirDatos']);


// Cesta compra

Route::get('/carrito', [CartController::class, 'mostrarCarrito']);
Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/increment/{id}', [CartController::class, 'incrementAmount'])->name('cart.increment');
Route::get('/decrement/{id}', [CartController::class, 'decrementAmount'])->name('cart.decrement');
Route::get('/delete/{id}', [CartController::class, 'deleteProduct'])->name('cart.delete');
