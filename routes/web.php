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


//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});
Route::middleware(['auth'])->group(function () 
{
	//Productos
	Route::post('productos/store', 'ProductoController@store')->name('productos.store')
		->middleware('permission:productos.create');

	Route::get('productos', 'ProductoController@index')->name('productos.index')
		->middleware('permission:productos.index');

	Route::get('productos/create', 'ProductoController@create')->name('productos.create')
		->middleware('permission:productos.create');

	Route::put('productos/{producto}', 'ProductoController@update')->name('productos.update')
		->middleware('permission:productos.edit');

	Route::get('productos/{producto}', 'ProductoController@show')->name('productos.show')
		->middleware('permission:productos.show');

	Route::delete('productos/{producto}', 'ProductoController@destroy')->name('productos.destroy')
		->middleware('permission:productos.destroy');

	Route::get('productos/{producto}/edit', 'ProductoController@edit')->name('productos.edit')
		->middleware('permission:productos.edit');

		//CATEGORIAS
	Route::post('categorias/store', 'CategoriaController@store')->name('categorias.store')
		->middleware('permission:categorias.create');

	Route::get('categorias', 'CategoriaController@index')->name('categorias.index')
		->middleware('permission:categorias.index');

	Route::get('categorias/create', 'CategoriaController@create')->name('categorias.create')
		->middleware('permission:categorias.create');

	Route::put('categorias/{categoria}', 'CategoriaController@update')->name('categorias.update')
		->middleware('permission:categorias.edit');

	Route::get('categorias/{categoria}', 'CategoriaController@show')->name('categorias.show')
		->middleware('permission:categorias.show');

	Route::delete('categorias/{categoria}', 'CategoriaController@destroy')->name('categorias.destroy')
		->middleware('permission:categorias.destroy');

	Route::get('categorias/{categoria}/edit', 'CategoriaController@edit')->name('categorias.edit')
		->middleware('permission:categorias.edit');

		//MARCAS
	Route::post('marcas/store', 'MarcaController@store')->name('marcas.store')
		->middleware('permission:marcas.create');

	Route::get('marcas', 'MarcaController@index')->name('marcas.index')
		->middleware('permission:marcas.index');

	Route::get('marcas/create', 'MarcaController@create')->name('marcas.create')
		->middleware('permission:marcas.create');

	Route::put('marcas/{marca}', 'MarcaController@update')->name('marcas.update')
		->middleware('permission:marcas.edit');

	Route::get('marcas/{marca}', 'MarcaController@show')->name('marcas.show')
		->middleware('permission:marcas.show');

	Route::delete('marcas/{marca}', 'MarcaController@destroy')->name('marcas.destroy')
		->middleware('permission:marcas.destroy');

	Route::get('marcas/{marca}/edit', 'MarcaController@edit')->name('marcas.edit')
		->middleware('permission:marcas.edit');





	});

Route::get('user/profile/{user}', 'UserController@editProfile')->name('user.edit.profile');;
Route::patch('user/profile/{user}', 'UserController@updateProfile')->name('user.update.profile');;

Route::resource('admin/configurations', 'ConfigurationController');
Route::resource('admin/roles', 'RoleController');
Route::resource('admin/users', 'UserController');
Route::get('/admin/user/{user}/menu', 'UserController@menu')->name('user.menu');;
Route::patch('/admin/user/menu/{user}', 'UserController@menuStore')->name('users.menuStore');

Route::get('/admin/option/create/{padre}', 'OptionMenuController@create');
Route::get('/admin/option/orden', 'OptionMenuController@updateOrden');
Route::post('/admin/option/orden', 'OptionMenuController@updateOrden');
Route::resource('/admin/option',"OptionMenuController");



Route::resource('clientes', 'ClienteController');

Route::resource('stock', 'StockController');

Route::resource('roles', 'RoleController');

Route::get('/invoice', 'InvoiceController@index');
Route::get('/invoice/add', 'InvoiceController@add');
Route::get('/invoice/detail/{id}', 'InvoiceController@detail');
Route::get('/invoice/pdf/{id}', 'InvoiceController@pdf');
Route::get('/invoice/findPersona', 'InvoiceController@findPersona');
Route::get('/invoice/findProducto', 'InvoiceController@findProducto');
Route::post('/invoice/save', 'InvoiceController@save');

Route::get('/factura_compra', 'FacturaCompraController@index');
Route::get('/factura_compra/add', 'FacturaCompraController@add');
Route::get('/factura_compra/detail/{id}', 'FacturaCompraController@detail');
Route::get('/factura_compra/pdf/{id}', 'FacturaCompraController@pdf');
Route::get('/factura_compra/findPersona', 'FacturaCompraController@findPersona');
Route::get('/factura_compra/findProducto', 'FacturaCompraController@findProducto');
Route::post('/factura_compra/save', 'FacturaCompraController@save');

Route::get('/presupuesto', 'PresupuestoController@index');
Route::get('/presupuesto/add', 'PresupuestoController@add');
Route::get('/presupuesto/detail/{id}', 'PresupuestoController@detail');
Route::get('/presupuesto/pdf/{id}', 'PresupuestoController@pdf');
Route::get('/presupuesto/findPersona', 'PresupuestoController@findPersona');
Route::get('/presupuesto/findProducto', 'PresupuestoController@findProducto');
Route::get('/presupuesto/findUser', 'PresupuestoController@findUser');
Route::post('/presupuesto/save', 'PresupuestoController@save');

Route::resource('contactos', 'ContactoController');



Route::resource('proveedores', 'ProveedorController');







Route::resource('proveedors', 'ProveedorController');

Route::resource('autorizacionCtaCtes', 'AutorizacionCtaCteController');