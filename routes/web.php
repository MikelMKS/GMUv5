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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Middleware\RedmineSession;
use App\Http\Middleware\GMUSession;

route::get('/','LoginController@login')->name('login');
route::get('login','LoginController@login')->name('login');
route::post('valida','LoginController@valida')->name('valida');
route::get('closesesion','LoginController@closesesion')->name('closesesion');


Route::middleware([RedmineSession::class])->group(function () {

    route::get('index','InicioController@index')->name('index');
    route::get('tabla','InicioController@tabla')->name('tabla');
    
    Route::middleware([GMUSession::class])->group(function () {
        // ADMINISTRATIVOS
        route::get('administrativos','AdministrativosController@index')->name('administrativos');
        route::get('agregarAdministrativo','AdministrativosController@agregarAdministrativo')->name('agregarAdministrativo');
        route::post('guardarAdministrativo','AdministrativosController@guardarAdministrativo')->name('guardarAdministrativo');
        route::post('accionesAdministrativo','AdministrativosController@accionesAdministrativo')->name('accionesAdministrativo');
    });

});