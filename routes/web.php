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

    //  ALERTAS
    route::get('revisarAlertas','AlertasController@revisarAlertas')->name('revisarAlertas');
    route::get('verNotificacion','AlertasController@verNotificacion')->name('verNotificacion');
    route::get('enteradoCumpleaños','AlertasController@enteradoCumpleaños')->name('enteradoCumpleaños');

    route::get('index','InicioController@index')->name('index');
    route::get('tabla','InicioController@tabla')->name('tabla');
    
    route::get('editarPerfil','LoginController@editarPerfil')->name('editarPerfil');
    route::post('updatePerfil','LoginController@updatePerfil')->name('updatePerfil');
    
    Route::middleware([GMUSession::class])->group(function () {
        // ADMINISTRATIVOS
        route::get('administrativos','AdministrativosController@index')->name('administrativos');
        route::get('agregarAdministrativo','AdministrativosController@agregarAdministrativo')->name('agregarAdministrativo');
        route::post('guardarAdministrativo','AdministrativosController@guardarAdministrativo')->name('guardarAdministrativo');
        route::get('editarAdministrativo','AdministrativosController@editarAdministrativo')->name('editarAdministrativo');
        route::post('updateAdministrativo','AdministrativosController@updateAdministrativo')->name('updateAdministrativo');
        route::post('accionesAdministrativo','AdministrativosController@accionesAdministrativo')->name('accionesAdministrativo');
    });

    // CLIENTES
    route::get('clientes','ClientesController@index')->name('clientes');
    route::get('agregarClienteMain','ClientesController@agregarClienteMain')->name('agregarClienteMain');
    route::post('guardarCliente','ClientesController@guardarCliente')->name('guardarCliente');
    
    route::get('verCliente','ClientesController@verCliente')->name('verCliente');
    route::post('updateCliente','ClientesController@updateCliente')->name('updateCliente');
    

    // SERICIOS
    route::get('servicios','ServiciosController@index')->name('servicios');
    route::get('serviciosTabla','ServiciosController@serviciosTabla')->name('serviciosTabla');
    route::get('deudaCliente','ServiciosController@deudaCliente')->name('deudaCliente');
    route::get('buscaMembresiasActivas','ServiciosController@buscaMembresiasActivas')->name('buscaMembresiasActivas');
    route::post('guardarServicio','ServiciosController@guardarServicio')->name('guardarServicio');
    route::get('agregarServicioMain','ServiciosController@agregarServicioMain')->name('agregarServicioMain');


    // REPORTES
    route::get('reportes','ReportesController@index')->name('reportes');
    route::get('reportePendientes','ReportesController@reportePendientes')->name('reportePendientes');

});