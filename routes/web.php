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

Route::get('/', array('uses' => 'UsuarioController@index'));
Route::post('login', array('uses' => 'UsuarioController@login'));
Route::get('salir', array('uses' => 'UsuarioController@logout'));

Route::get('/mistareas', 'TareaController@index');
Route::post('/mistareas/add', 'TareaController@store');
Route::post('/mistareas/estado', 'TareaController@status');
Route::post('/mistareas/borrar', 'TareaController@destroy');
Route::post('/mistareas/filtro', 'TareaController@search');
