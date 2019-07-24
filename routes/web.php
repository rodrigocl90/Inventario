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

//pattern


        
Route::get('home', 'HomeController@index');

Route::group(['middleware' => 'fw-only-whitelisted'], function () 
    {






Route::pattern('id', '\d+');
Route::pattern('hash', '[a-z0-9]+');
Route::pattern('hex', '[a-f0-9]+');
Route::pattern('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
Route::pattern('base', '[a-zA-Z0-9]+');
Route::pattern('slug', '[a-z0-9-]+');
Route::pattern('username', '[a-z0-9_-]{3,16}');

///







//LOGIN
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');



// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


 



/////////////////////////////////////////////////////////////////////////////////////////////////auuuuuuuuthhhhhhhhhhhhhhhh


Route::group(['middleware' => ['auth']], function() {

	
Route::group(['prefix' => 'admin'], function() {
		

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/////////////////////////////////////////////////////LOGINS


Route::get('logs',['as'=>'logs.logslist','uses'=>'LoginsController@logslist','middleware' => ['permission:logs-list']]);

Route::get('logs/delete',['as'=>'logs.delete','uses'=>'LoginsController@deletelogs','middleware' => ['permission:logs-list']]);


Route::get('logs/mylogins',['as'=>'logs.mylogs','uses'=>'LoginsController@mylogins']);  /////VIGILAR




	///////////////////////////////////////////////LOGINS





/////////////////////////////////BACKPUP

Route::get('backup',['as'=>'backup.list','uses'=>'BackupController@index','middleware' => ['permission:backup-admin']]);
Route::get('backup/create',['as'=>'backup.create','uses'=>'BackupController@create','middleware' => ['permission:backup-admin']]);
Route::get('backup/download/{file_name}',['as'=>'backup.download','uses'=>'BackupController@download','middleware' => ['permission:backup-admin']]);
Route::get('backup/delete/{file_name}',['as'=>'backup.delete','uses'=>'BackupController@delete','middleware' => ['permission:backup-admin']]);



/////////////////////////////////BACKUP





///////////////////////////////////////////////contraseña cambio



Route::get('users/profile','UserController@profile')->name('profile');

Route::post('users/changePassword','CambiarContraseñaController@changePassword')->name('changePassword');


Route::get('users/changePassword','CambiarContraseñaController@showChangePasswordForm');


/////////////////////////////////////////////contraseña cambio

//////////////////////////////////////roles




Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-create|role-update|role-delete|role-list']]);
   
    Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);


   Route::post('roles/store',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);


    Route::get('roles/{slug}',['as'=>'roles.show','uses'=>'RoleController@show','middleware' => ['permission:role-list']]);

	Route::get('roles/{slug}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-update']]);
	
	Route::patch('roles/{slug}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-update']]);


	Route::get('roles/delete/{slug}',['as'=>'roles.showdelete','uses'=>'RoleController@showdelete','middleware' => ['permission:user-delete']]);

	Route::delete('roles/{slug}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);
	//////////////////////////////////////roles



	//////////////////////////////////////USUARIOS


Route::get('users',['as'=>'users.index','uses'=>'UserController@index','middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);


 Route::get('users/create',['as'=>'users.create','uses'=>'UserController@create','middleware' => ['permission:user-create']]);


   Route::post('users/store',['as'=>'users.store','uses'=>'UserController@store','middleware' => ['permission:user-create']]);


Route::get('users/{slug}',['as'=>'users.show','uses'=>'UserController@show','middleware' => ['permission:user-list']]);

   Route::get('users/{slug}/edit',['as'=>'users.edit','uses'=>'UserController@edit','middleware' => ['permission:user-update']]);

 Route::patch('users/{id}',['as'=>'users.update','uses'=>'UserController@update','middleware' => ['permission:user-update']]);


Route::get('users/delete/{slug}',['as'=>'users.showdelete','uses'=>'UserController@showdelete','middleware' => ['permission:user-delete']]);


Route::delete('users/{slug}',['as'=>'roles.destroy','uses'=>'UserController@destroy','middleware' => ['permission:role-delete']]);


	//////////////////////////////////////usuarios












	//////////////////////////////////////Categorias

Route::get('categorias',['as'=>'categorias.index','uses'=>'CategoriasController@index','middleware' => ['permission:categorias']]);




   Route::post('categorias/ccrud/store',['as'=>'categorias.store','uses'=>'CategoriasController@store','middleware' => ['permission:categorias']]);



   Route::get('categorias/ccrud/edit/{id}',['as'=>'categorias.edit','uses'=>'CategoriasController@edit','middleware' => ['permission:categorias']]);


 Route::post('categorias/ccrud',['as'=>'categorias.update','uses'=>'CategoriasController@update','middleware' => ['permission:categorias']]);




Route::delete('categorias/ccrud/destroy/{id}',['as'=>'categorias.destroy','uses'=>'CategoriasController@destroy','middleware' => ['permission:categorias']]);


	//////////////////////////////////////Ctegorias














	//////////////////////////////////////Proveedores

Route::get('proveedores',['as'=>'proveedores.index','uses'=>'ProveedoresController@index','middleware' => ['permission:proveedores']]);




   Route::post('proveedores/pcrud/store',['as'=>'proveedores.store','uses'=>'ProveedoresController@store','middleware' => ['permission:proveedores']]);



   Route::get('proveedores/pcrud/edit/{id}',['as'=>'proveedores.edit','uses'=>'ProveedoresController@edit','middleware' => ['permission:proveedores']]);


 Route::post('proveedores/pcrud',['as'=>'proveedores.update','uses'=>'ProveedoresController@update','middleware' => ['permission:proveedores']]);




Route::delete('proveedores/pcrud/destroy/{id}',['as'=>'proveedores.destroy','uses'=>'ProveedoresController@destroy','middleware' => ['permission:proveedores']]);


	//////////////////////////////////////Proveedores






	//////////////////////////////////////Clientes

Route::get('clientes',['as'=>'clientes.index','uses'=>'ClientesController@index','middleware' => ['permission:clientes']]);




   Route::post('clientes/clcrud/store',['as'=>'clientes.store','uses'=>'ClientesController@store','middleware' => ['permission:clientes']]);



   Route::get('clientes/clcrud/edit/{id}',['as'=>'clientes.edit','uses'=>'ClientesController@edit','middleware' => ['permission:clientes']]);


 Route::post('clientes/clcrud',['as'=>'clientes.update','uses'=>'ClientesController@update','middleware' => ['permission:clientes']]);




Route::delete('clientes/clcrud/destroy/{id}',['as'=>'clientes.destroy','uses'=>'ClientesController@destroy','middleware' => ['permission:clientes']]);


	//////////////////////////////////////Clientes









	//////////////////////////////////////Productos

Route::get('productos',['as'=>'productos.index','uses'=>'ProductosController@index','middleware' => ['permission:productos']]);



  Route::get('productos/prcrud/barcode/{barcode}',['as'=>'productos.barcode','uses'=>'ProductosController@barcode','middleware' => ['permission:productos']]);




   Route::post('productos/prcrud/store',['as'=>'productos.store','uses'=>'ProductosController@store','middleware' => ['permission:productos']]);



   Route::get('productos/prcrud/edit/{id}',['as'=>'productos.edit','uses'=>'ProductosController@edit','middleware' => ['permission:productos']]);


 Route::post('productos/prcrud',['as'=>'productos.update','uses'=>'ProductosController@update','middleware' => ['permission:productos']]);




Route::delete('productos/prcrud/destroy/{id}',['as'=>'productos.destroy','uses'=>'ProductosController@destroy','middleware' => ['permission:productos']]);


	//////////////////////////////////////Clientes










	//////////////////////////////////////Empresa

Route::get('empresa',['as'=>'empresa.index','uses'=>'EmpresaController@index','middleware' => ['permission:empresa']]);


Route::get('empresa/edit',['as'=>'empresa.edit','uses'=>'EmpresaController@edit','middleware' => ['permission:empresa']]);


Route::patch('empresa/edit',['as'=>'empresa.update','uses'=>'EmpresaController@update','middleware' => ['permission:empresa']]);
	//////////////////////////////////////Empresa










	//////////////////////////////////////entradas temporales

Route::get('entradas/create',['as'=>'entradas.create','uses'=>'EntradasController@create','middleware' => ['permission:entradas']]);



Route::get('ajax',['as'=>'ajax','uses'=>'EntradasController@ajax','middleware' => ['permission:entradas']]);



Route::get('ajax1',['as'=>'ajax1','uses'=>'EntradasController@ajax1','middleware' => ['permission:entradas']]);






Route::get('entradas/temporal/tabla/',['as'=>'entradas.temporal','uses'=>'EntradasController@temporale','middleware' => ['permission:entradas']]);


Route::post('entrada/temporales',['as'=>'ingreso.temporal','uses'=>'EntradasController@storetemporales','middleware' => ['permission:entradas']]);




Route::delete('entradas/temporal/destroy/{id}',['as'=>'entrada.temporal.destroy','uses'=>'EntradasController@destroy','middleware' => ['permission:entradas']]);

	//////////////////////////////////////entradas










	//////////////////////////////////////entradas operacion



Route::post('entrada/operacion/create',['as'=>'ingreso.operacion.entrada','uses'=>'OperacionController@entradastore','middleware' => ['permission:entradas']]);





Route::get('entradas/operacion/index/',['as'=>'entradas.index','uses'=>'EntradasController@index','middleware' => ['permission:entradas']]);





Route::post('entrada/operacion/index/change',['as'=>'entradas.operacion.estado','uses'=>'EntradasController@estado','middleware' => ['permission:entradas']]);






  Route::get('entradas/operacion/cuerpo/{id}',['as'=>'entradas.cuerpo','uses'=>'EntradasController@cuerpo','middleware' => ['permission:entradas']]);






Route::get('entradas/operacion/imprimir/{id}',['as'=>'imprimir_entrada','uses'=>'EntradasController@imprimir','middleware' => ['permission:entradas']]);



	//////////////////////////////////////entradas









	//////////////////////////////////////SALIDAS


Route::get('salidas/operacion/index/',['as'=>'salidas.index','uses'=>'SalidasController@index','middleware' => ['permission:salidas']]);



Route::get('salidas/create',['as'=>'salidas.create','uses'=>'SalidasController@create','middleware' => ['permission:salidas']]);


Route::get('salidas/ajaxclientes',['as'=>'ajax_clientes','uses'=>'SalidasController@ajaxclientes','middleware' => ['permission:salidas']]);

Route::post('salidas/temporales/create',['as'=>'ingreso.temporal.ventas','uses'=>'SalidasController@StoreTemporales','middleware' => ['permission:salidas']]);





Route::get('salidas/temporales/tabla/',['as'=>'salidas.temporal','uses'=>'SalidasController@cargas','middleware' => ['permission:salidas']]);








Route::delete('salidas/temporales/destroy/{id}',['as'=>'salidas.temporal.destroy','uses'=>'SalidasController@destroy','middleware' => ['permission:salidas']]);




Route::post('salidas/operacion/create',['as'=>'ingreso.operacion.venta','uses'=>'SalidasController@ingreso','middleware' => ['permission:salidas']]);



	//////////////////////////////////////SALIDAS






Route::get('salidas/operacion/cuerpo/{id}',['as'=>'salidas.cuerpo','uses'=>'SalidasController@cuerpo','middleware' => ['permission:salidas']]);






Route::get('salidas/operacion/imprimir/{id}',['as'=>'imprimir_salida','uses'=>'SalidasController@imprimir','middleware' => ['permission:salidas']]);








});
});



});
