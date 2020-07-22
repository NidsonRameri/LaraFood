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
Route::get('/tenants/{uuid}', 'Api\TenantApiController@show');
Route::get('/tenants', 'Api\TenantApiController@index');

Route::get('/categories/{url}', 'Api\CategoryApiController@show'); //Criando API --- 1º PASSO =>(prox)=> CategoryApiController
Route::get('/categories', 'Api\CategoryApiController@categoriesByTenant');

Route::get('/tables/{identify}', 'Api\TableApiController@show'); //Criando API --- 1º PASSO =>(prox)=> TableApiController
Route::get('/tables', 'Api\TableApiController@tablesByTenant');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
