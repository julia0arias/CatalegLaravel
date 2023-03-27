<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\productosController;
use App\Http\Controllers\categoriasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CompraRealizadaController;
use App\Http\Controllers\ValoracionesController;
use App\Http\Controllers\StripePaymentController;

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

// Mostrar vistas

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacto', function () {
    return view('contacto');
});


// Categorias
Route::get('/categorias', [categoriasController::class, 'show']);
Route::get('/eliminarCategoria/{id}', [categoriasController::class, 'delete'])->middleware(['auth', 'is_admin']);
Route::get('/modificarCategoria/{id}', [categoriasController::class, 'subirDatos'])->middleware(['auth', 'is_admin']);
Route::post('/accion', [categoriasController::class, 'accion'])->middleware(['auth', 'is_admin']);

// Productos

Route::get('/productos', function () {
    return view('productos');
});
Route::get('/productos', [productosController::class, 'show']);
Route::get('/eliminar/{id}', [productosController::class, 'delete'])->middleware(['auth', 'is_admin']);
Route::get('/modificar/{id}', [productosController::class, 'subirDatos'])->middleware(['auth', 'is_admin']);
Route::post('/anadirProducto', [productosController::class, 'accion'])->middleware(['auth', 'is_admin']);

// Logout

Route::get('/logout', [AuthController::class, 'logout']);

// Crud usuarios

Route::post('/accionUsuarios', [UsuariosController::class, 'accion'])->middleware(['auth', 'is_admin']);
Route::get('/usuarios', [UsuariosController::class, 'show'])->middleware(['auth', 'is_admin']);

// Logins

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/eliminarUsuario/{id}', [UsuariosController::class, 'delete'])->middleware(['auth', 'is_admin']);
Route::get('/modificarUsuario/{id}', [UsuariosController::class, 'subirDatos'])->middleware(['auth', 'is_admin']);

// Cesta compra

Route::get('/carrito', [CartController::class, 'mostrarCarrito'])->middleware(['auth', 'is_logged']);
Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add')->middleware(['auth', 'is_logged']);
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware(['auth', 'is_logged']);
Route::get('/increment/{id}', [CartController::class, 'incrementAmount'])->name('cart.increment')->middleware(['auth', 'is_logged']);
Route::get('/decrement/{id}', [CartController::class, 'decrementAmount'])->name('cart.decrement')->middleware(['auth', 'is_logged']);
Route::get('/delete/{id}', [CartController::class, 'deleteProduct'])->name('cart.delete')->middleware(['auth', 'is_logged']);

// Ruta generar pdf con libreria tcpdf y compra realizada

Route::get('/factura', [CompraRealizadaController::class, 'imprimirFactura'])->middleware(['auth', 'is_logged']);
Route::get('/compraRealizada', [CompraRealizadaController::class, 'show'])->middleware(['auth', 'is_logged']);

// Valoraciones

Route::post('/valoracion', [ValoracionesController::class, 'anadirValoracion'])->name('valoracion.add')->middleware(['auth', 'is_logged']);

// Stripe
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
