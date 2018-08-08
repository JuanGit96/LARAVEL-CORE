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

/*
*Definiendo ruta para el Home
*/
Route::get('/', function () {
    return view('welcome'); //respuesta
});


/**
 * Definiendo rutas para Empleados
 */

Route::get('/empleados', 'EmployeeController@index')//'ruta','Accion'
                        ->name('employees.index'); 

/*detalle de usuarios */
Route::get('/empleados/{employee}', 'EmployeeController@detail')->where('employee','[0-9]+')
                                                           ->name('employees.detail');
//Solo numeros y puede ser mas de un numero('parametro','expresion regular')  

/* Definiendo ruta para crear usuarios*/
Route::get('/empleados/nuevo','EmployeeController@new')->name('employees.new');
Route::post('/empleados', 'EmployeeController@store');


/*Rutas para edición de usuario */

Route::get('/empleados/{employee}/editar', 'EmployeeController@edit')->where('employee','[0-9]+')
                                                            ->name('employees.edit');

Route::put('/empleados/{employee}','EmployeeController@update')->where('employee','[0-9]+');
                                                                                                                 
/*Rutas para eliminarusuario */
Route::delete('/empleados/eliminar/{employee}', 'EmployeeController@delete')->where('employee','[0-9]+')
->name('employees.delete');


 

/**
 * Definiendo rutas para Profesiones
 */

Route::get('/profesiones', 'ProfessionController@index')->name('professions.index'); 

/*detalle de usuarios */
Route::get('/profesiones/{profession}', 'ProfessionController@detail')
                                                           ->where('profession','[0-9]+')
                                                           ->name('professions.detail'); 

/* Definiendo ruta para crear usuarios*/
Route::get('/profesiones/nuevo','ProfessionController@new')->name('professions.new');
Route::post('/profesiones', 'ProfessionController@store');


/*Rutas para edición de usuario */
Route::get('/profesiones/{profession}/editar', 'ProfessionController@edit')
                                                            ->where('profession','[0-9]+')
                                                            ->name('professions.edit');

Route::put('/profesiones/{profession}','ProfessionController@update')->where('profession','[0-9]+');
                                                                                                                 
/*Rutas para eliminarusuario */
Route::delete('/profesiones/eliminar/{profession}', 'ProfessionController@delete')
->where('profession','[0-9]+')
->name('professions.delete'); 




/**
 * Definiendo rutas para Compañias
 */

Route::get('/compañias', 'CompanyController@index')->name('companies.index'); 

/*detalle de usuarios */
Route::get('/compañias/{company}', 'CompanyController@detail')
                                                           ->where('company','[0-9]+')
                                                           ->name('companies.detail'); 

/* Definiendo ruta para crear usuarios*/
Route::get('/compañias/nuevo','CompanyController@new')->name('companies.new');
Route::post('/compañias', 'CompanyController@store');


/*Rutas para edición de usuario */
Route::get('/compañias/{company}/editar', 'CompanyController@edit')
                                                            ->where('company','[0-9]+')
                                                            ->name('companies.edit');

Route::put('/compañias/{company}','CompanyController@update')->where('company','[0-9]+');
                                                                                                                 
/*Rutas para eliminarusuario */
Route::delete('/compañias/eliminar/{company}', 'CompanyController@delete')
->where('company','[0-9]+')
->name('companies.delete'); 



/**
 * RUTAS PARA AUTENTICACION
 */

/*Auth::routes();*/
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home'); //Bienvenida al registro exitoso


/*Rutas Login con redes sociales (Socialite) */

Route::get('/redirect/{provider}', 'Auth\SocialController@redirectToProvider');
/*ruta de respuesta */
Route::get('/callback/{provider}', 'Auth\SocialController@handleProviderCallback');
