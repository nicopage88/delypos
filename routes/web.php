<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'Auth\LoginController@showLoginForm')->middleware('guest');
Route::post('login','Auth\LoginController@login')->name('login');
Route::get('dashboard','DashboardController@index')->name('dashboard');

Route::get('panel/productos', 'ProductoController@index')->name('index.producto');
Route::get('panel/producto/registrar', 'ProductoController@create')->name('create.producto');
Route::post('panel/producto/registrar', 'ProductoController@store')->name('store.producto');
Route::get('panel/producto/{codigo}/editar', 'ProductoController@edit')->name('edit.producto');
Route::patch('panel/producto/{id}/editar', 'ProductoController@update')->name('update.producto');
Route::get('panel/producto/barcode/{codigo}', 'ProductoController@codigo')->name('codigo.producto');
Route::get('panel/producto/inventario', 'ProductoController@inventario')->name('inventario.producto');
Route::patch('panel/producto/{id}/stock', 'ProductoController@stock')->name('stock.producto');

Route::get('panel/productos/historial', 'ProductoController@ingresos')->name('ingresos.producto');
Route::get('panel/productos/codigos', 'ProductoController@imprimir_codigos')->name('imprimir_codigos.producto');
Route::delete('panel/producto/{id}', 'ProductoController@eliminar')->name('eliminar.producto');

/*USUARIOS*/
Route::get('panel/usuarios', 'UserController@index')->name('index.usuario');
Route::get('panel/usuario/registrar', 'UserController@create')->name('create.usuario');
Route::post('panel/usuario/registrar', 'UserController@store')->name('store.usuario');
Route::get('panel/usuario/{dni}/editar', 'UserController@edit')->name('edit.usuario');
Route::patch('panel/usuario/{id}/editar', 'UserController@update')->name('update.usuario');

/**CONTABILIDAD */
Route::get('panel/contabilidad', 'ContabilidadController@index')->name('index.contabilidad');
Route::get('panel/contabilidad/gastos', 'ContabilidadController@gastos')->name('gastos.contabilidad');
Route::post('panel/contabilidad/gastos', 'ContabilidadController@store_gasto')->name('store_gasto.contabilidad');
Route::get('panel/abrir_caja', 'ContabilidadController@abrir_caja')->name('abrir_caja.contabilidad');
Route::post('panel/abrir_caja', 'ContabilidadController@store_abrir_caja')->name('store_abrir_caja.contabilidad');
Route::get('panel/cerrar_caja/{id}', 'ContabilidadController@cerrar_caja')->name('cerrar_caja.contabilidad');
Route::patch('panel/cerrar_caja/{id}', 'ContabilidadController@store_cerrar_caja')->name('store_cerrar_caja.contabilidad');

Route::get('panel/ganancias/mensual', 'ContabilidadController@semanal')->name('semanal.contabilidad');
Route::get('panel/margen/historial', 'ContabilidadController@historial')->name('historial.contabilidad');

/**VENTAS */
Route::get('panel/venta/generar', 'VentaController@registro')->name('registro.venta');
Route::post('panel/venta/generar', 'VentaController@store')->name('store.venta');
Route::get('panel/ventas/historial', 'VentaController@open_gistorial')->name('open_gistorial.venta');
Route::get('panel/venta/factura/{id}', 'VentaController@factura')->name('factura.venta');
Route::get('panel/venta/detalles/{id}', 'VentaController@detalles')->name('detalles.venta');
Route::patch('panel/venta/{id}', 'VentaController@cancelar_venta')->name('cancelar_venta.venta');
Route::get('panel/venta/enviar/{id}', 'VentaController@enviar_correo')->name('enviar.venta');
Route::get('panel/venta/rendimiento', 'VentaController@grafico')->name('grafico.venta');

/*CONFIG */
Route::get('panel/configuraciones/general', 'ConfigController@general')->name('general.config');
Route::patch('panel/configuraciones/general/{id}', 'ConfigController@editar_config')->name('editar_config.config');
Route::get('panel/configuraciones/factura', 'ConfigController@factura')->name('factura.config');
Route::post('panel/configuraciones/factura', 'ConfigController@save_cambios')->name('save_cambios.config');
Route::get('panel/configuraciones/banners', 'ConfigController@banner')->name('banner.config');
Route::post('panel/configuraciones/banners', 'ConfigController@banner_store')->name('banner_store.config');
Route::delete('panel/configuraciones/banners/{id}', 'ConfigController@banner_delete')->name('banner_delete.config');

/*INVENTARIO */
Route::get('panel/almacen/inventario', 'InventarioController@index')->name('index.inventario');
Route::get('panel/almacen/data', 'InventarioController@data')->name('data.inventario');

/*MAIL */

Route::get('panel/mensajeria/enviar-correo', 'MailController@index')->name('index.mail');
Route::post('panel/mensajeria/enviar-correo', 'MailController@store')->name('store.mail');

/*CAJAS */
Route::get('panel/caja/{codigo}/data', 'DetallesController@data_caja')->name('data_caja.detalle');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
