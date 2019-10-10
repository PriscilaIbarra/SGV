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
Route::get('/altaTiposCargo','TiposCargoController@create' )->name('agregarTiposCargo');
Route::post('/altaTiposCargo','TiposCargoController@store' )->name('altaTiposCargo');
Route::get('/editarTipoCargo/{id}','TiposCargoController@edit' )->name('editarTipoCargo');
Route::post('/actualizarTipoCargo','TiposCargoController@update' )->name('updateTiposCargo');
Route::get('/abmlTipoCargo/{id}','TiposCargoController@logic_delete' )->name('deleteTipoCargo');

Route::get('/abmlTiposUsuarios','TipoUsuarioController@index')->name('abmlTiposUsuarios');
Route::get('/altaTiposUsuarios','TipoUsuarioController@create' )->name('agregarTiposUsuarios');
Route::post('/altaTiposUsuarios','TipoUsuarioController@store' )->name('altaTiposUsuarios');
Route::get('/editarTiposUsuarios/{id}','TipoUsuarioController@edit' )->name('editarTiposUsuarios');
Route::post('/actualizarTipoUsuario','TipoUsuarioController@update' )->name('updateTiposUsuarios');
Route::get('/abmlTiposUsuarios/{id}','TipoUsuarioController@logic_delete' )->name('deleteTiposUsuarios');

Route::get('/abmlVacantes','VacanteController@index' )->name('abmlVacantes');
Route::get('/altaVacante','VacanteController@create' )->name('altaVacante');
Route::post('/agregarVacante','VacanteController@store' )->name('agregarVacante');
Route::get('/editarVacante/{id}','VacanteController@edit' )->name('editarVacante');
Route::post('/updateVacante','VacanteController@update' )->name('updateVacante');
Route::get('/deleteVacante/{id}','VacanteController@logic_delete' )->name('deleteVacante');