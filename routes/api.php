<?php

use Illuminate\Http\Request;

use App\Tenant;

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


Route::group(['middleware' => 'check.token'], function () {
    Route::get('authors', 'AuthorsController@list');
    Route::get('comics/{authorId}', 'ComicsController@get');
});


