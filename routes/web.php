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

route::get('/','LoginController@login')->name('login');
route::get('login','LoginController@login')->name('login');

route::post('valida','LoginController@valida')->name('valida');


Route::middleware([RedmineSession::class])->group(function () {

    route::get('inicio','InicioController@index')->name('inicio');

});