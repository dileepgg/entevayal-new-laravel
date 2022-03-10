<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controllers;
use App\Http\Controllers\API\FarmerApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', 'App\Http\Controllers\PassportAuthController@register');
Route::post('login', 'App\Http\Controllers\PassportAuthController@login');
Route::post('logout', 'App\Http\Controllers\PassportAuthController@logout');

Route::middleware('auth:api')->group( function () {
      Route::resource('farmer', FarmerApiController::class);
});