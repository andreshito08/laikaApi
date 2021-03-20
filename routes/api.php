<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api_token')->get('/tipoidentificacion','App\Http\Controllers\TipoIdentificacionController@index');
Route::middleware('api_token')->get('/tipoidentificacion/{id}','App\Http\Controllers\TipoIdentificacionController@show')->where('id','[0-9]+');
Route::middleware('api_token')->post('/tipoidentificacion','App\Http\Controllers\TipoIdentificacionController@create');
Route::middleware('api_token')->put('/tipoidentificacion/{id}','App\Http\Controllers\TipoIdentificacionController@update')->where('id','[0-9]+');
Route::middleware('api_token')->delete('/tipoidentificacion/{id}','App\Http\Controllers\TipoIdentificacionController@destroy')->where('id','[0-9]+');

Route::middleware('api_token')->get('/usuarios','App\Http\Controllers\UsuarioController@index');
Route::middleware('api_token')->get('/usuarios/{id}','App\Http\Controllers\UsuarioController@show')->where('id','[0-9]+');
Route::middleware('api_token')->post('/usuarios','App\Http\Controllers\UsuarioController@create');
Route::middleware('api_token')->put('/usuarios/{id}','App\Http\Controllers\UsuarioController@update')->where('id','[0-9]+');
Route::middleware('api_token')->delete('/usuarios/{id}','App\Http\Controllers\UsuarioController@destroy')->where('id','[0-9]+');
