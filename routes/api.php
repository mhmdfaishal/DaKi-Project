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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('authAPI:api')->group(function ()
{
    Route::prefix('home')->group(function () {
        Route::post('/gunung/store', [API\HomeController::class, 'storeGunung']);
        Route::post('/gunung/update', [API\HomeController::class, 'updateGunung']);
        Route::delete('/gunung/delete_gunung', [API\HomeController::class, 'destroyGunung']);
    });
});