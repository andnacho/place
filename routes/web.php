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
    return view('seguridad.usuario.login');
 })->name('seguridadLogin');
 
//routes para la generación de pago sencillo
Route::view('/pagos', 'pagos.registrarPago');
Route::post('/rest', 'PlacetopayController@pago')->name('pagos.registro');
Route::get('/response', 'PlacetopayController@respuestaCompleja')->name('pagos.respuesta'); 
// Route::get('/response', 'PlacetopayController@respuesta')->name('pagos.respuesta'); respuesta sencilla
Route::get('/consultar', 'PlacetopayController@consultar');


//Resources del almacen
 Route::resource('almacen/categoria', 'CategoriaController');
 Route::resource('almacen/articulo', 'ArticuloController');
 Route::resource('compras/proveedor', 'ProveedorController');
 Route::resource('compras/ingreso', 'IngresoController');
 Route::get('compas/{id}/pagar', 'IngresoController@pagar')->name('ingreso.pagar');
 Route::resource('seguridad/usuario', 'UserController');
 
 
 Route::get('barcode', function () {
     return view('barcode.barcode');
 });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
