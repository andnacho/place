<?php



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

Route::view('/pagos', 'pagos.registrarPago');
Route::post('rest', 'PlacetopayController@pago')->name('pagos.registro');


Route::get('/', function () {
    return view('seguridad.usuario.login');
 })->name('seguridadLogin');
 
 Route::resource('almacen/categoria', 'CategoriaController');
 Route::resource('almacen/articulo', 'ArticuloController');
 Route::resource('ventas/cliente', 'ClienteController');
 Route::resource('compras/proveedor', 'ProveedorController');
 Route::resource('compras/ingreso', 'IngresoController');
 Route::resource('ventas/ventas', 'VentaController');
 Route::resource('seguridad/usuario', 'UserController');
 
 
 Route::get('barcode', function () {
     return view('barcode.barcode');
 });
