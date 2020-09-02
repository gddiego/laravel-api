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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/info', function () {
    return phpinfo();
});

Route::group(['prefix' => 'session'], function () {
    Route::post('/login', 'LoginController@login');
    Route::post('/registrar', 'APIController@register');
});

Route::group(['middleware' => ['Autentication']], function () {
    Route::group(['prefix' => 'v1'], function () {

        Route::post('/list', 'APIController@index');
        Route::post('/list/{id}', 'APIController@show');
        Route::put('/users/{id}', 'APIController@update');
        Route::delete('/delete/{id}', 'APIController@destroy');


        Route::resource('pessoa', 'PessoaController');
        Route::resource('produtos', 'ProdutoController');
    });
});
