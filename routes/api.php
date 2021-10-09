<?php

use Illuminate\Http\Request;

use App\Http\Middleware\CheckToken;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\ComicsController;
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

Route::group(['middleware' => [CheckToken::class]], function () {
    Route::get('authors', [AuthorsController::class, 'list'])->middleware("cors");;
    Route::get('comics/{authorId}', [ComicsController::class, 'get'])->middleware("cors");;
});
