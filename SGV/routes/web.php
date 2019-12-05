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



Route::get('/','AsignaturaController@index')->name('Principal');

Route::get('/listadoVacantesOfAsig/{id}','VacanteController@getVacantesOfAsig')->name('listadoVacantes');

Route::get('/PantallaPrincipalAdm', ['middleware' => 'auth',function () {
    return view('Administrador.pantallaPrincipalAdmin');
}])->name('homeAdmin');

Route::get('/PantallaPrincipalJefeCatedra',['middleware' => 'auth', 'uses' => 'VacanteController@getVacantesCalificar'])->name('homeJefeCatedra');	

Auth::routes();

Route::get('/home',['middleware' => 'auth',function()
{

	if(strcasecmp(Auth::user()->tipo_usuario->descripcion,"Usuario")==0)
	{
		return redirect(route('asignConVacants'));	
	}
	elseif (strcasecmp(Auth::user()->tipo_usuario->descripcion,"Administrador")==0)
	{
	    return redirect(route('homeAdmin'));
	}
	elseif (strcasecmp(Auth::user()->tipo_usuario->descripcion,"Jefe de Catedra")==0) 
	{
	    return redirect(route('homeJefeCatedra'));
	}	
	
 
}])->name('home');

Route::get('/menu',function()
{

	if(strcasecmp(Auth::user()->tipo_usuario->descripcion,"Usuario")==0)
	{
		return redirect(route('asignConVacants'));	
	}
	elseif (strcasecmp(Auth::user()->tipo_usuario->descripcion,"Administrador")==0)
	{
	    return redirect(route('homeAdmin'));
	}
	elseif (strcasecmp(Auth::user()->tipo_usuario->descripcion,"Jefe de Catedra")==0) 
	{
	    return redirect(route('homeJefeCatedra'));
	}	
	
 
})->name('menu');

Route::get('/updatePasswordOk',['middleware' => 'auth', function()
{

	$msg="Constraseña actualizada con éxito";
	
	if(strcasecmp(Auth::user()->tipo_usuario->descripcion,"Usuario")==0)
	{
		return redirect(route('asignConVacants'))->with('success',$msg);	
	}
	elseif (strcasecmp(Auth::user()->tipo_usuario->descripcion,"Administrador")==0)
	{
	    return redirect(route('homeAdmin'))->with('success',$msg);
	}
	elseif (strcasecmp(Auth::user()->tipo_usuario->descripcion,"Jefe de Catedra")==0) 
	{
	    return redirect(route('homeJefeCatedra'))->with('success',$msg);
	}	
	
 
}])->name('updatePasswordOk');




Route::get('/abmlUsuarios', ['middleware' => 'auth', 'uses' => 'UserController@index'])->name('abmlUsuarios');
Route::get('/altaUsuario',['middleware' => 'auth', 'uses' =>'UserController@create' ])->name('altaUsuario');
Route::post('/agregarUsuario',['middleware' => 'auth', 'uses' =>'UserController@store'] )->name('agregarUsuario');
Route::get('/editarUsuario/{id}',['middleware' => 'auth', 'uses' =>'UserController@edit'] )->name('editarUsuario');
Route::post('/updateUsuario',['middleware' => 'auth', 'uses' =>'UserController@update'] )->name('updateUsuario');
Route::get('/abmlUsuarios/{id}',['middleware' => 'auth', 'uses' =>'UserController@logic_delete'] )->name('deleteUsuarios');

Route::get('/abmlTipoCargo',['middleware' => 'auth', 'uses' =>'TiposCargoController@index'])->name('abmlTipoCargo');
Route::get('/altaTiposCargo',['middleware' => 'auth', 'uses' =>'TiposCargoController@create'] )->name('agregarTiposCargo');
Route::post('/altaTiposCargo',['middleware' => 'auth', 'uses' =>'TiposCargoController@store'] )->name('altaTiposCargo');
Route::get('/editarTipoCargo/{id}',['middleware' => 'auth', 'uses' =>'TiposCargoController@edit'] )->name('editarTipoCargo');
Route::post('/actualizarTipoCargo',['middleware' => 'auth', 'uses' =>'TiposCargoController@update']  )->name('updateTiposCargo');
Route::get('/abmlTipoCargo/{id}',['middleware' => 'auth', 'uses' =>'TiposCargoController@logic_delete'] )->name('deleteTipoCargo');

Route::get('/abmlTiposUsuarios',['middleware' => 'auth', 'uses' =>'TipoUsuarioController@index'])->name('abmlTiposUsuarios');
Route::get('/altaTiposUsuarios',['middleware' => 'auth', 'uses' =>'TipoUsuarioController@create'] )->name('agregarTiposUsuarios');
Route::post('/altaTiposUsuarios',['middleware' => 'auth', 'uses' =>'TipoUsuarioController@store'] )->name('altaTiposUsuarios');
Route::get('/editarTiposUsuarios/{id}',['middleware' => 'auth', 'uses' =>'TipoUsuarioController@edit'] )->name('editarTiposUsuarios');
Route::post('/actualizarTipoUsuario',['middleware' => 'auth', 'uses' =>'TipoUsuarioController@update'] )->name('updateTiposUsuarios');
Route::get('/abmlTiposUsuarios/{id}',['middleware' => 'auth', 'uses' =>'TipoUsuarioController@logic_delete'])->name('deleteTiposUsuarios');

Route::get('/abmlVacantes',['middleware' => 'auth', 'uses' =>'VacanteController@index'] )->name('abmlVacantes');
Route::get('/altaVacante',['middleware' => 'auth', 'uses' =>'VacanteController@create'] )->name('altaVacante');
Route::post('/agregarVacante',['middleware' => 'auth', 'uses' =>'VacanteController@store'] )->name('agregarVacante');
Route::get('/editarVacante/{id}',['middleware' => 'auth', 'uses' =>'VacanteController@edit'] )->name('editarVacante');
Route::post('/updateVacante','VacanteController@update' )->name('updateVacante');
Route::get('/deleteVacante/{id}',['middleware' => 'auth', 'uses' =>'VacanteController@logic_delete'] )->name('deleteVacante');




Route::get('/listAsignaturasConVacantes',['middleware' => 'auth', 'uses' =>'AsignaturaController@getAsignaturasConVacantes'])->name('asignConVacants');
Route::get('/listarVacantesDeAsig/{id}',['middleware' => 'auth', 'uses' =>'VacanteController@getVacantesByAsig'])->name('listVacantesDeAsignatura');
Route::get('/inscribirseVacante/{id}',['middleware' => 'auth', 'uses' =>'InscripcionController@create'])->name('inscribirseVacante');


Route::post('/altaInscripcion',['middleware' => 'auth', 'uses' =>'InscripcionController@store'])->name('registrarInscripcion');

Route::get('/listadoInscripciones',['middleware' => 'auth', 'uses' =>'InscripcionController@index'])->name('listadoInscripciones');
Route::get('/visualizarCV/{id}',['middleware' => 'auth', 'uses' =>'PDFController@show'])->name('visualizarCV');

Route::get('/imprimirVacante/{id}',['middleware' => 'auth', 'uses' =>'PDFController@printVacante'])->name('imprimirVacante');

Route::get('/asignarJefesDeCatedra/',['middleware' => 'auth', 'uses' =>'AsignaturaController@getAll'])->name('asignarJefesDeCatedra');


Route::post('/registarAsigJefC',['middleware' => 'auth', 'uses' =>'AsignaturaController@asignarJefe'])->name('registarAsigJefC');



Route::get('/listarInscriptos/{id_vacante}',['middleware' => 'auth', 'uses' =>'VacanteController@getVacanteById'])->name('listarInscriptos');


Route::get('/calificarOrdenMerito/{id_vacante}',['middleware' => 'auth', 'uses' =>'VacanteController@agregarCalificaciones'])->name('calificarOrdenMerito');

 

Route::post('/actualizarCalificaciones',['middleware' => 'auth', 'uses' =>'InscripcionController@updateCalificaciones'])->name('actualizarCalificaciones');


Route::get('/confecionarOrdenMerito/{id_vacante}',['middleware' => 'auth', 'uses' =>'VacanteController@generarOrdenMerito'])->name('confecionarOrdenMerito');



Route::get('/generarConstancia/{id_vacante}',['middleware' => 'auth', 'uses' =>'VacanteController@generarConstancia'])->name('generarConstancia');

Route::get('/generarPDF/{id_vacante}',['middleware' => 'auth', 'uses' =>'PDFController@generarPDF'])->name('generarPDF');


Route::get('/listarOrdenesDeMerito/',['middleware' => 'auth', 'uses' =>'VacanteController@getVacantesCalificadasByJefeCatedra'])->name('listarOrdenesDeMerito');

Route::get('/visualizarConstancia/{id_orden}/',['middleware' => 'auth', 'uses' =>'PDFController@visualizarConstancia'])->name('visualizarConstancia');


Route::get('/cambiarPassword',['middleware' => 'auth', 'uses' =>'UserController@cambiarPassword'])->name('cambiarPassword');

Route::post('/updatePass',['middleware' => 'auth', 'uses' =>'UserController@updatePass'])->name('updatePass');