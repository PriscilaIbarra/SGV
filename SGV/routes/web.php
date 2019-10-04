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

Route::get('/PantallaPrincipalUsuario', function () {
    return view('Usuario.pantallaPrincipalUsuario');
})->name('homeUser');

Route::get('/PantallaPrincipalAdm', function () {
    return view('Administrador.pantallaPrincipalAdmin');
})->name('homeAdmin');

Route::get('/PantallaPrincipalJefeCatedra', function () {
    return view('JefeCatedra.pantallaPrincipalJefeC');
})->name('homeJefeCatedra');

Auth::routes();

Route::get('/home', function()
{
	switch (Auth::user()->id_tipo_usuario)
	{
		case 1:
			return redirect(route('homeUser'));			
			break;
		
		case 2:
		    return redirect(route('homeAdmin'));
			break;
		
		case 3:
		    return redirect(route('homeJefeCatedra'));
			break;		
		
	}
})->name('home');


Route::get('/abmlUsuarios','UserController@index' )->name('abmlUsuarios');
Route::get('/altaUsuario','UserController@create' )->name('altaUsuario');
Route::post('/agregarUsuario','UserController@store' )->name('agregarUsuario');
Route::get('/editarUsuario/{id}','UserController@edit' )->name('editarUsuario');
Route::post('/updateUsuario','UserController@update' )->name('updateUsuario');
Route::get('/abmlUsuarios/{id}','UserController@logic_delete' )->name('deleteUsuarios');

Route::get('/abmlTipoCargo','TiposCargoController@index')->name('abmlTipoCargo');
Route::post('/agregarTipoCargo','TiposCargoController@store' )->name('agregarTipoCargo');
Route::get('/editarTipoCargo/{id}','TiposCargoController@edit' )->name('editarTipoCargo');
Route::get('/abmlTipoCargo/{id}','TiposCargoController@edit' )->name('editarTipoCargo');
Route::get('/abmlTipoCargo/{id}','TiposCargoController@logic_delete' )->name('deleteTipoCargo');
