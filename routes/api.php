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

Route::post('/auth/register', 'Api\Auth\RegisterController@store');
Route::post('/auth/token', "Api\Auth\AuthClientController@auth");

Route::group(["middleware" => ["auth:sanctum"]], 
    function(){    
        Route::get('/me', "Api\Auth\AuthClientController@me"); //tem que ter o middleware
        Route::post('/logout', "Api\Auth\AuthClientController@logout"); //tem que ter o middleware
    
        Route::post('/auth/v1/orders/{identifyOrder}/evaluations', "Api\EvaluationApiController@store");

        Route::get('/auth/v1/my-orders', "Api\OrderApiController@myOrders");
        Route::post('auth/v1/orders', "Api\OrderApiController@store");
    
    });



Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    
    Route::get('/tenants/{uuid}', 'TenantApiController@show');
    Route::get('/tenants', 'TenantApiController@index');

    Route::get('/categories/{identify}', 'CategoryApiController@show'); //Criando API --- 1º PASSO =>(prox)=> CategoryApiController
    Route::get('/categories', 'CategoryApiController@categoriesByTenant');

    Route::get('/tables/{identify}', 'TableApiController@show'); //Criando API --- 1º PASSO =>(prox)=> TableApiController
    Route::get('/tables', 'TableApiController@tablesByTenant');

    Route::get('/products/{identify}', 'ProductApiController@show');
    Route::get('/products', 'ProductApiController@productsByTenant');

    Route::post('/orders', "OrderApiController@store");    
    Route::get('/orders/{identify}', "OrderApiController@show");

});
    



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
