<?php
Auth::routes();
/* INICIO */
Route::get('/', function () {
    return view('inicio');
});
//error
Route::get('/cuentaNoValida',function(){
    return view('errorCuenta');
});
//login google
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback','Auth\GoogleController@handleGoogleCallback');

/* PROFESORES */

//formulario
Route::get('homeProfesor/formIncidencia', 'HomeController@formNuevaIncidencia' );
Route::post('homeProfesor/formIncidencia', 'HomeController@RegistrarNuevaIncidencia' );
//verDatos
Route::get('/mostrarDato/{id}',['uses' =>'HomeController@mostrarDatos']);
//Formulario editar incidencia
Route::get('/editar/{id}','HomeController@Editar');
Route::post('/editar','HomeController@EditarFinalizar');
//home
Route::get('/homeProfesor', 'HomeController@profesor');
Route::get('/homeProfesor/{mensaje}', 'HomeController@profesor');

/* ADMINISTRADORES */

//home
Route::get('/homeAdmin', 'HomeController@admin');
//update asignar admin

// esto hace que un admin pueda apropiarse de una incidencia
Route::get('/adquirir/{id}','HomeController@adquirir');
Route::post('/adquirir/{id}','HomeController@adquirirFin');
Route::get('/updateAdmin/{id}','HomeController@updateAdmin');
Route::post('/updateAdmin','HomeController@updateAdminFin');
//estado
Route::get('/estado/{id}','HomeController@estado');
Route::post('/estado','HomeController@estadoFin');
